<?php 

/**
 * ホーム(index.php)の制御クラス
 * @version 1.0.0
 * @since 2021-10-5
 * @author kenji  uehara
 * @desc DBからコンテンツのテキストや画像パスを取得など。
 *
 */
class HomeController{
    
    var $md; // モデルクラス
    
    public function __construct(){

        require_once 'model/Home.php';
        $this->md = new Home();
        
    }
    
    
    public function indexAction(){
        $data = $this->md->getContensData(); // コンテンツデータをDBから取得する
        $data = $this->md->convContensData($data); // コンテンツデータの変換
        
        $box = $data;
        return $box;
    }
    
    
    
    
}