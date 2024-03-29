<?php
namespace common\widgets;

class Helper
{
    /**
     * 给域名补全http
     * @param string $domain
     */
    public static function repairDomain($domain){
        if (!preg_match('/^http:\/\/|https:\/\//', $domain)) {
            $domain = "http://" . $domain;
        }
        if (preg_match('/\/$/', $domain)) {
            $domain = substr($domain, 0, -1);
        }
        return $domain;
    }
    
    /**
     * 正则替换url中的各种ID
     * @param unknown $url
     * @param unknown $id
     * @param string $mark
     * @return mixed
     */
    public static function dealUrlId($url,$id,$mark='') {
        if($mark){
            $mark = preg_replace('/<{bookid}>/i', $id, $mark);
            $mark_id = self::calcMark($mark);
            //替换mark_id
            $url = preg_replace('/<{markid}>/i', $mark_id, $url);
        }
        
        //替换URL中的小说ID
        $url = preg_replace('/<{bookid}>/i', $id, $url);
        return $url;
    }
    
    /**
	 * 处理节点中文章子序号和 章节子序号的运算   暂时只支持一步运算
	 * @param string $strnum   含加减乘数的字符串
	 * @return number          运算后的结果
	 */
    public function calcMark($strnum){
        $subchapterid_jia = explode('+', $strnum);
        if(isset($subchapterid_jia['1'])){
            return ($subchapterid_jia[0] + $subchapterid_jia[1]);
        }
        $subchapterid_jian = explode('-', $strnum);
        if(isset($subchapterid_jian['1'])){
            return ($subchapterid_jian[0] - $subchapterid_jian[1]);
        }
        $subchapterid_chen = explode('*', $strnum);
        if(isset($subchapterid_chen['1'])){
            return ($subchapterid_chen[0] * $subchapterid_chen[1]);
        }
        $subchapterid_chu = explode('%%', $strnum);
        if(isset($subchapterid_chu['1'])){
            return floor($subchapterid_chu[0] / $subchapterid_chu[1]);
        }
        $subchapterid_chu = explode('%', $strnum);
        if(isset($subchapterid_chu['1'])){
            return ($subchapterid_chu[0] % $subchapterid_chu[1]);
        }
        return '';
    }
    
    /**
     * 匹配符合的链接
     * @param unknown $link
     * @param unknown $preg
     */
    public static function pregLinks($link, $preg){
        $preg = self::dealRegular($preg);
        $result = preg_match('/'.$preg.'/i', $link);
        return ($result > 0) ? $link : '';
    }
    
    /**
     * 获取符合的链接和描文本
     * @param string $str
     * @param string $preg
     */
    public static function pregLinksText($str, $preg){
        $preg = self::dealRegular($preg);
        preg_match_all('/href\s*=\s*[\"\']?('.$preg.')[\"\']?[^\>]+>([^<]+)\<\s*\/a\s*\>/i', $str, $result);
        //preg_match_all('/href\s*=\s*[\"\']?('.$preg.')[\"\']?[^\>]+>([^<]+)\<\s*\/a\s*\>/i', $str, $result);
        unset($result[0]);
        return $result;
    }
    
    /**
     * 获取正则后的内容
     * @param string $str
     * @param string $preg
     */
    public static function pregAll($str, $preg){
        preg_match_all('/'.$preg.'/i', $str, $result);
        return $result[1];
    }
    
    /**
     * 正则获取的标题
     * @param unknown $str
     */
    public static function pregTitle($str){
        preg_match_all('/<h1>([^<]+)<\/h1>/i', $str, $result);
        return $result[1];
    }
    
    /**
     * 采集参数正则转换
     * @param  string $str 转换前的参数
     * @return array  $str 转换后的正则表达式数组
     */
    public static function dealRegular($str){
        $str = addslashes($str);
        $str = preg_replace('/\(/', '\(', $str);
        $str = preg_replace('/\)/', '\)', $str);
        $str = preg_replace('/\//', '\/', $str);
        $str = preg_replace('/\$/', '\d+', $str);
        $str = preg_replace('/\./', '\.', $str);
        $str = preg_replace('/\?/', '\?', $str);
        $str = preg_replace('/(\r\n)|(\n)/', '[\r\n|\n]*', $str);
        $str = preg_replace('/@/', '&nbsp;', $str);
        
        $str = preg_replace('/\*\*\*\*/', '([\w\W]*)', $str);
        return $str;
    }
    
    /**
     * 把字符串检测并转为UTF8编码
     * @param unknown $str
     * @return string
     */
    public static function iconvUTF8($str){
        $encode_arr = array('ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP','UTF-8');
        $encoded = mb_detect_encoding($str, $encode_arr);
        /* self::WriteLog($encoded);
        if(empty($encoded)){
            self::WriteLog('不限制查编码');
            $newencoded = mb_detect_encoding($str);
            self::WriteLog($newencoded);
            $encode_arr = array('ASCII','GB2312','GBK','UTF-8','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
            $newencoded = mb_detect_encoding($str,$encode_arr);
            self::WriteLog($newencoded);
            $encoded = 'GBK';
        } */
//         $str = ($encoded != 'UTF-8') ? mb_convert_encoding($str,'UTF-8',$encoded) : $str;
        $str = ($encoded != 'UTF-8') ? iconv($encoded,'UTF-8//IGNORE',$str) : $str;
        return $str;
    }
    
    /**
     * 补全链接
     * @param unknown $links
     * @param unknown $domain
     */
    public static function expandlinks($links, $domain) {
        preg_match("/^[^\?]+/", $domain, $match);

        $match = preg_replace("|/[^\/\.]+\.[^\/\.]+$|", "", $match[0]);
        $match = preg_replace("|/$|", "", $match);
        $match_part = parse_url($match);
        $match_root = $match_part["scheme"] . "://" . $match_part["host"];
        
        if(substr($domain, -1) == '/'){
            $domain = substr($domain, 0, -1);
        }

        $search = array(
            "|^(\/)|i",
            "|^(?!http://)(?!https://)(?!mailto:)|i",
            "|/(\./)|",
            //"|/[^\/]+/\.\./|"
        );

        $replace = array($match_root . "/",
            $domain . "/",
            $domain."/",
            //"/"
        );

        $expandedLinks = preg_replace($search, $replace, $links);

        return $expandedLinks;
    }
    
    /**
     * 给结果按照关键字加em标签
     * @param unknown $str
     * @param unknown $keyword
     * @return mixed
     */
    public static function getRedKeyWord($str, $keyword){
        $ks = explode(' ',$keyword);
        foreach($ks as $k)
        {
            $k = trim($k);
            if($k=='')
            {
                continue;
            }
            if(ord($k[0])>0x80 && strlen($k)<2)
            {
                continue;
            }
            // 这里不区分大小写进行关键词替换
            $str = str_ireplace($k, "<em>$k</em>", $str);
            // 速度更快,效率更高
            //$fstr = str_replace($k, "<font color='red'>$k</font>", $fstr);
        }
        return $str;
    }
    
    /**
     * 判断是否是wap访问 true 是wap
     */
    public static function isMoblie(){
        // 先检查是否为wap代理，准确度高
        if(isset($_SERVER['HTTP_VIA']) && stristr($_SERVER['HTTP_VIA'],"wap")){
            return true;
        }
        // 检查浏览器是否接受 WML.
        elseif(isset($_SERVER['HTTP_ACCEPT']) && strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0){
            return true;
        }
        //检查USER_AGENT
        elseif(isset($_SERVER['HTTP_USER_AGENT']) && preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
     * 错误提示赋值到session，前台调用alert组件输出提示信息
     * @param string|array $error
     */
    public static function showError($error)
    {
        if (is_array($error)) {
            $str = '';
            foreach ($error as $k => $v) {
                $str .= (is_array($v)) ? $v[0] : $v;
                $str .= ' ';
            }
        } else {
            $str = $error;
        }
        \Yii::$app->session->setFlash('error', $str);
    }
    
    /**
     * 成功提示赋值到session，前台调用alert组件输出提示信息
     * @param string|array $success
     */
    public static function showSuccess($success)
    {
        if (is_array($success)) {
            $str = '';
            foreach ($success as $k => $v) {
                $str .= (is_array($v)) ? $v[0] : $v;
                $str .= ' ';
            }
        } else {
            $str = $success;
        }
        \Yii::$app->session->setFlash('success', $str);
    }
    
    /**
     * 获取设置curl IP的数据
     * @param string $ip
     */
    public static function getCurlIp($ip=''){
        if(empty($ip))$ip = \Yii::$app->request->userIP;
        return array('X-FORWARDED-FOR:'.$ip, 'CLIENT-IP:'.$ip);
    }
    
    /**
     * 写入文章内容保存为inc文件
     * @param int    $sort_id    栏目ID
     * @param int    $book_id    小说ID
     * @param int    $article_id 文章ID
     * @param string $body       文章内容
     */
    public static function WriteLog($str,$file='../../logs/log.log',$type='a')
    {
        $str .= "\r\n============================================================================\r\n";
        @$fp = fopen($file,$type);
        @flock($fp);
        @fwrite($fp,$str);
        @fclose($fp);
    }
}