<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Books;
use yii\data\Pagination;
use common\models\Domain;
use common\widgets\Helper;
use common\widgets\Curl;
use yii\helpers\Url;
use common\widgets\dic\SplitWord;
use common\models\Keywords;

class BookController extends Controller{
    
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    public function actionIndex(){
        return $this->renderPartial('index');
    }
    
    /**
     * 搜索
     * @return string
     */
    public function actionSearch(){
        $wd    = mb_substr(htmlspecialchars(\Yii::$app->request->get('wd')), 0, 50);
        
        //分词



//         $keyword='我是真的很爱你';
//         $cfg_soft_lang='utf-8';
//         $sp = new SplitWord($cfg_soft_lang, $cfg_soft_lang);
//         $sp->SetSource($keyword, $cfg_soft_lang, $cfg_soft_lang);
//         $sp->SetResultType(2);
//         $sp->StartAnalysis(TRUE);
//         $keywords = $sp->GetFinallyResult(' ');
        
//         $keywords = preg_replace("/[ ]{1,}/", " ", trim($keywords));
//         echo $keywords;
        
        if($wd == '')return $this->redirect('index');
        
        $where = $this->dealKeywords($wd);
        
        //$query = Books::find()->filterWhere(['like','name',$wd]);
        $query = Books::find()->where($where);
        
        $countQuery = clone $query;
        $count      = $countQuery->count();
        $pages      = new Pagination(['totalCount' => $count]);
        
        $models = $query->offset($pages->offset)
                  ->limit($pages->limit)
                  ->all();
        
        $hosts = $this->getHosts();
        
        return $this->renderPartial('search', ['models'=>$models,'pages'=>$pages,'wd'=>$wd, 'hosts'=>$hosts]);
    }
    
    
    public function dealKeywords($keyword){
//         $keyword = $this->getFenciKeywords($keyword);
        $keyword = preg_replace("/[ ]{1,}/", " ", trim($keyword));
    	$keywors = explode(' ', $keyword);
    	$where = [];
    	foreach ($keywors as $v){
    		if(!empty($v)){
    		    $this->saveKeyword($v);
    			$where[] = "CONCAT(`name`,`author`) like '%$v%'";
    		}
    	}
    	return implode(' OR ', $where);
    }
    
    /**
     * 分词
     * @param unknown $keyword
     */
    public function getFenciKeywords($keyword){
        $sp = new SplitWord();
        $sp->SetSource($keyword);
        $sp->SetResultType(2);
        $sp->StartAnalysis(TRUE);
        $keywords = $sp->GetFinallyResult(' ');

        $keywords = preg_replace("/[ ]{1,}/", " ", trim($keywords));
        return $keywords;
    }
    
    /**
     * 保存搜索关键字
     * @param unknown $keyword
     */
    public function saveKeyword($keyword){
        $model = Keywords::find()->where(['keyword'=>$keyword])->one();
        if($model){
            $model->count = $model->count + 1;
        }else{
            $model = new Keywords();
            $model->keyword = $keyword;
            $model->count = 1;
        }
        $model->save();
    }
    
    /**
     * 章节
     * @return \yii\web\Response
     */
    public function actionChapter() {
        $this->layout = 'header';
        $id = intval(\Yii::$app->request->get('bookid'));
        
        if(empty($id))return $this->redirect(['book/error']);
        
        $book = Books::findOne($id);
        if(!$book)return $this->redirect(['book/error']);
        
        /*$host = Domain::findOne($book->domain_id);
        $host->domain = Helper::repairDomain($host->domain);
        
        $url = Helper::expandlinks($host->book_regular,$host->domain);
        $url = Helper::dealUrlId($url, $book->book_id);
        
        $curl = new Curl();
        $curl->get($url);
        //$url = 'http://www.baidu.com';
        //$snoopy->fetch($url);
        //$snoopy->results = file_get_contents($url.'sds/');
       // print_r($curl->response);exit;
        
        if($curl->responseCode == 200){
            $regular = Helper::dealUrlId($host->chapter_regular, $book->book_id);
            $chapters =$this->collectLinks($curl->response, $regular);
            return $this->render('chapter', ['chapters'=>$chapters,'book'=>$book]);
        }else{
            return $this->redirect(['book/error']);
        }*/
        return $this->render('chapter', ['book'=>$book]);
    }
    
    public function actionAjaxchapter(){
        if(\Yii::$app->request->isAjax){
            $id = intval(\Yii::$app->request->get('bookid'));
            $book = Books::findOne($id);
            if(!$book){
                $result['code'] = -1;
                $result['msg']  = '参数错误';
                die(json_encode($result));
            }
            
            $host = Domain::findOne($book->domain_id);
            $host->domain = Helper::repairDomain($host->domain);
            
            $url = Helper::expandlinks($host->book_regular,$host->domain);
            $url = Helper::dealUrlId($url, $book->book_id, $host->book_mark_id);
            
            $curl = new Curl();
            $curl->get($url);
            
            if($curl->responseCode == 200){
                $regular = Helper::dealUrlId($host->chapter_regular, $book->book_id);
                $chapters =$this->collectLinks($curl->response, $regular);
                $chapterHtml = $this->chapterHtml($chapters, $book);
                $result['code'] = 0;
                $result['chapter'] = $chapterHtml;
                die(json_encode($result));
            }else{
                if($curl->responseCode == 404){
                    $result['code'] = -404;
                    $result['msg']  = '地址错误';
                    die(json_encode($result));
                }
                $result['code'] = -2;
                $result['msg']  = '解码失败，请稍后再试，或可点击<a href="'.$url.'" target="_blank">'.$url.'</a>前往原网站阅读。';
                die(json_encode($result));
            }
        }
    }
    
    public function actionArticle(){
        $this->layout = 'header';
        $u = base64_decode(urldecode(\Yii::$app->request->get('u')));
        /*$n = base64_decode(urldecode(\Yii::$app->request->get('n')));
        
        $domain_id = intval(\Yii::$app->request->get('doid'));
        $host = Domain::findOne($domain_id);
        $host->domain = Helper::repairDomain($host->domain);
        
        $url = Helper::expandlinks($u,$host->domain);
        
        $curl = new Curl();
        $curl->get($url);
        
        if($curl->responseCode == 200){
            $preg = Helper::dealRegular($host->content_regular);
            $content = $this->collectContent($curl->response, $preg);
            
            $paging_preg = Helper::dealRegular($host->paging_regular);
            $chapter_all_regular = Helper::expandlinks($host->chapter_regular,$host->domain);
            $chapter_regular = ($chapter_all_regular == $host->chapter_regular) ? $host->chapter_regular : $host->chapter_regular.'|'.$chapter_all_regular;
            $chapter_regular = preg_replace('/<{bookid}>/i', '$', $chapter_regular);
            $paging = $this->collectPaging($curl->response, $paging_preg, $chapter_regular);
            return $this->render('article',array('u'=>$u,'content'=>$content[0],'paging'=>$paging));
        }else{
            return $this->redirect(['book/error']);
        }*/
        return $this->render('article',array('u'=>$u));
    }
    
    /**
     * ajax获取文章内容
     */
    public function actionAjaxarticle(){
        if(\Yii::$app->request->isAjax){
            $u = base64_decode(urldecode(\Yii::$app->request->get('u')));
            $b = intval(\Yii::$app->request->get('b'));
            
            $domain_id = intval(\Yii::$app->request->get('doid'));
            $host = Domain::findOne($domain_id);
            if(!$host){
                $result['code'] = -1;
                $result['msg']  = '参数错误';
                die(json_encode($result));
            }
            $host->domain = Helper::repairDomain($host->domain);
            
            $url = Helper::expandlinks($host->book_regular,$host->domain);
            $url = Helper::dealUrlId($url, $b, $host->book_mark_id);
            $url = Helper::expandlinks($u,$url);
//             echo $url;exit;
            $curl = new Curl();
            $curl->get($url);
            
            if($curl->responseCode == 200){
                $content = Helper::iconvUTF8($curl->response);
                $preg = Helper::dealRegular($host->content_regular);
                $body = $this->collectContent($content, $preg);
                
                //获取标题
                $title = Helper::pregTitle($content);
            
                $paging_preg = Helper::dealRegular($host->paging_regular);
                $chapter_all_regular = Helper::expandlinks($host->chapter_regular,$host->domain);
                $chapter_regular = ($chapter_all_regular == $host->chapter_regular) ? $host->chapter_regular : $host->chapter_regular.'|'.$chapter_all_regular;
                $chapter_regular = preg_replace('/<{bookid}>/i', '$', $chapter_regular);
                $paging = $this->collectPaging($content, $paging_preg, $chapter_regular);
                $pagingHtml = $this->pagingHtml($paging);
            
                $result['code'] = 0;
                $result['title'] = $title;
                $result['content'] = $body[0];
                $result['paging'] = $pagingHtml;
                die(json_encode($result));
            }else{
                if($curl->responseCode == 404){
                    $result['code'] = -404;
                    $result['msg']  = '地址错误';
                    die(json_encode($result));
                }
                $result['code'] = -2;
                $result['msg']  = '解码失败，请稍后再试，或可点击<a href="'.$url.'" target="_blank">'.$url.'</a>前往原网站阅读。';
                die(json_encode($result));
            }
        }
    }
    
    /**
     * 拼接章节
     * @param unknown $chapters
     */
    public function chapterHtml($chapters, $book){
        $html = '';
        if(isset($chapters[1])):
            foreach ($chapters[1] as $k => $v):
                $html .= '<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 chapterlink"><a href="'.Url::to(['book/article', 'doid'=>$book->domain_id,'u'=>urlencode(base64_encode($v)),'b'=>$book->book_id]).'" title="'.$chapters[2][$k].'" target="_blank">'.$chapters[2][$k].'</a></div>';
            endforeach;
        endif;
        return $html;
    }
    
    /**
     * 拼接上下章
     * @param unknown $paging
     */
    public function pagingHtml($paging){
        $html = '';
        if($paging[2][0] == '上一章' || $paging[2][0] == '下一章'):
            $html .= '<div class="col-md-6 col-sm-6 col-xs-6"><a href="javascript:void(0);" class="getArticle" id="prev" data-url="';
            if(isset($paging[1][0]) && $paging[2][0] == '上一章')$html .= urlencode(base64_encode($paging[1][0]));
            $html .= '">上一章</a></div>';
            $html .= '<div class="col-md-6 col-sm-6 col-xs-6"><a href="javascript:void(0);" class="getArticle" id="next" data-url="';
            if(isset($paging[1][1])):
                $html .= urlencode(base64_encode($paging[1][1]));
            elseif ($paging[2][0] == '下一章'):
                $html .= urlencode(base64_encode($paging[1][0]));
            endif;
            $html .= '">下一章</a></div>';
         else :
            $html .= '<div class="col-md-6 col-sm-6 col-xs-6">';
            if(isset($paging[1][0]))$html .= '<a href="javascript:void(0);" class="getArticle" id="prev" data-url="'.urlencode(base64_encode($paging[1][0])).'">'.$paging[2][0].'</a>';
            $html .= '</div>';
            $html .= '<div class="col-md-6 col-sm-6 col-xs-6">';
            if(isset($paging[1][1]))$html .= '<a href="javascript:void(0);" class="getArticle" id="next" data-url="'.urlencode(base64_encode($paging[1][1])).'">'.$paging[2][1].'</a>';
            $html .= '</div>';
        endif;
        return $html;
    }
    
    /**
     * 获取符合的链接及内容
     * @param unknown $content
     * @param unknown $regular
     */
    public function collectLinks($content, $regular){
        $content = Helper::iconvUTF8($content);
        $links   = Helper::pregLinksText($content, $regular);
        return $links;
    }
    
    /**
     * 获取正则后的内容
     * @param unknown $content
     * @param unknown $regular
     */
    public function collectContent($content, $regular){
        $content = Helper::iconvUTF8($content);
        $str   = Helper::pregAll($content, $regular);
        return $str;
    }
    
    /**
     * 正则获取上下页
     * @param unknown $content
     * @param unknown $regular
     */
    public function collectPaging($content, $regular, $chapterReg){
        $content = Helper::iconvUTF8($content);
        $str   = Helper::pregAll($content, $regular);
        $paging   = Helper::pregLinksText($str[0], $chapterReg);
        return $paging;
    }
    
    /**
     * 过滤不匹配的链接
     * @param unknown $links
     * @param unknown $regular
     * @return string|array
     */
    public function getTrueLinks($links, $regular){
        $new_links = '';
        if(is_array($links)){
            foreach ($links as $v){
                $link = Helper::pregLinks($v,$regular);
                if($link)$new_links[] = $link;
            }
        }else{
            $new_links = Helper::pregLinks($v,$regular);
        }
        return $new_links;
    }
    
    /**
     * 获取采集域名列表
     * @return Ambigous <multitype:, unknown>
     */
    public function getHosts(){
        $arr = array();
        $domains = Domain::find()->asArray()->All();
        
        foreach ($domains as $v){
            $arr[$v['id']]['name']   = $v['name'];
            $arr[$v['id']]['domain'] = $v['domain'];
        }
        return $arr;
    }
    
    /* public function actionError(){
        return $this->render('error');
    } */
    
}