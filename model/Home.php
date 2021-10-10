<?php

/**
 * ホーム(index.php)のモデルクラス
 * @version 1.0.0
 * @since 2021-10-5
 * @author kenji  uehara
 * @desc DBからコンテンツのテキストや画像パスを取得など。
 *
 */
class Home{
    
    var $dao;
    
    public function __construct(){
        
        require_once CRUD_BASE_PATH . 'PdoDao.php';
        $this->dao = new PdoDao();
        
    }
    
    /**
     * コンテンツデータを取得する
     * @return [] コンテンツデータ
     */
    public function getContensData(){
        $sql = "SELECT * FROM contents WHERE page_id = 1";
        $data = $this->dao->getData($sql);
        return $data;
    }
    
    
    /**
     * コンテンツデータの変換処理
     * @param [] data コンテンツデータ
     * @return [] 返還後のコンテンツデータ
     */
    public function convContensData($data){
        $data2 = [];
        
        $aImgIds = $this->extractAImgIds($data); // コンテンツデータからA画像IDリストを抽出する。
        
        $aImgData = $this->getAImgData($aImgIds); // A画像IDリストに紐づくA画像データを取得する
        
        $aImgHm = $this->convImgDataToHashmap($aImgData); // A画像データをA画像ハッシュマップに構造変換する
        
        $data = $this->setAImgHmInData($data, $aImgHm); // データにA画像ハッシュマップをセットする。
        
        $data2 = $this->convDataToHashmap($data); // IDをキーとしたハッシュマップ構造に変換する
        
        return $data2;
    }
    
    
    /**
     *  コンテンツデータからA画像IDリストを抽出する。
     * @param [] $data コンテンツデータ
     * @return [] A画像IDリスト
     */
    private function extractAImgIds(&$data){
        $aImgIds = [];
        
        foreach($data as $ent){
            if(!empty($ent['a_img_id'])){
                if(empty($ent['img_fp'])){
                    $aImgIds[] = $ent['a_img_id'];
                }
            }
        }
        
        return $aImgIds;
    }
    
    
    /**
     * A画像IDリストに紐づくA画像データを取得する
     * @param [] $aImgIds A画像IDリスト
     * @return [] A画像データ
     */
    private function getAImgData($aImgIds){
        if(empty($aImgIds)) return [];
        
        $ids_str = "'" . implode("','", $aImgIds) . "'";
        $sql = "SELECT id, img_fp FROM a_imgs WHERE id IN({$ids_str})";
        $aImgData = $this->dao->getData($sql);
        return $aImgData;
        
    }
    
    
    /**
     * A画像データをA画像ハッシュマップに構造変換する
     * @param [] $aImgData A画像データ
     * @return [] A画像ハッシュマップ
     */
    public function convImgDataToHashmap($aImgData){
        $aImgHm = [];
        if(empty($aImgData)) return [];
        
        foreach($aImgData as &$ent){
            $id = $ent['id'];
            $aImgHm[$id] = $ent['img_fp'];
        }
        unset($ent);
        
        return $aImgHm;
    }
    
    
    /**
     * コンテンツデータにA画像ハッシュマップをセットする。
     * @param [] $data コンテンツデータ
     * @param [] $aImgHm A画像ハッシュマップ
     * @return [] コンテンツデータ
     */
    private function setAImgHmInData(&$data, &$aImgHm){
        if(empty($aImgHm)) return [];
        
        foreach($data as &$ent){
            
            
            if(!empty($ent['img_fp'])) {
                // アップロード型である場合
                $img_fp = $ent['img_fp'];
                $img_fp = '/coralpaint_mng/public/' . $img_fp;
                $img_fp_md = str_replace( '/orig/', '/mid/', $img_fp);
                $ent['img_fp'] = $img_fp;
                $ent['img_fp_md'] = $img_fp_md;
                
            }else{
                if(empty($ent['a_img_id'])) continue;
                // A画像ファイルパスをセット
                $a_img_id = $ent['a_img_id'];
                if(empty($aImgHm[$a_img_id])) continue;
                $img_fp = $aImgHm[$a_img_id];
                $ent['img_fp'] = $img_fp;
                $img_fp_md = str_replace( '/orig/', '/mid/', $img_fp);
                $ent['img_fp_md'] = $img_fp_md;
            }
            
            

        }
        unset($ent);
        
        return $data;
    }
    
    
    /**
     * IDをキーとしたハッシュマップ構造に変換する
     * @param [] $data コンテンツデータ
     * @return [] ハッシュマップ構造のコンテンツデータ
     */
    private function convDataToHashmap($data){
        if(empty($data)) return [];
        $data2 = [];
        
        foreach($data as $ent){
            $id = $ent['id'];
            $data2[$id] = $ent;
        }
       
        return $data2;
    }
    
    
    /**
     * カルーセルデータを取得する
     */
    public function getCarousels(){
        $sql = "SELECT * FROM contents WHERE page_id = 2 ORDER BY sort_no";
        $data = $this->dao->getData($sql);

        $aImgIds = $this->extractAImgIds($data); // コンテンツデータからA画像IDリストを抽出する。
        
        $aImgData = $this->getAImgData($aImgIds); // A画像IDリストに紐づくA画像データを取得する
        
        $aImgHm = $this->convImgDataToHashmap($aImgData); // A画像データをA画像ハッシュマップに構造変換する
        
        $data = $this->setAImgHmInData($data, $aImgHm); // データにA画像ハッシュマップをセットする。
        
        $data2 = $this->convDataToHashmap($data); // IDをキーとしたハッシュマップ構造に変換する
        
        return $data2;
        
    }
    
    
    
}