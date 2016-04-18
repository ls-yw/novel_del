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
     * @return mixed
     */
    public static function dealUrlId($url,$id) {
        //替换URL中的小说ID
        $url = preg_replace('/<{bookid}>/i', $id, $url);
        return $url;
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
        $str = preg_replace('/\//', '\/', $str);
        $str = preg_replace('/\$/', '\d+', $str);
        $str = preg_replace('/\./', '\.', $str);
        $str = preg_replace('/\?/', '\?', $str);
        
        $str = preg_replace('/\*\*\*\*/', '([\w\W]*)', $str);
        return $str;
    }
    
    /**
     * 把字符串检测并转为UTF8编码
     * @param unknown $str
     * @return string
     */
    public static function iconvUTF8($str){
        $encode_arr = array('UTF-8','ASCII','GBK','GB2312','BIG5','JIS','eucjp-win','sjis-win','EUC-JP');
        $encoded = mb_detect_encoding($str, $encode_arr);
        $str = ($encoded != 'UTF-8') ? mb_convert_encoding($str,'UTF-8',$encoded) : $str;
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

        $search = array(
            "|^(\/)|i",
            "|^(?!http://)(?!mailto:)|i",
            "|/\./|",
            "|/[^\/]+/\.\./|"
        );

        $replace = array("",
            $match_root . "/",
            $match . "/",
            "/",
            "/"
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
}