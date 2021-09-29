<?php

namespace App\Http\Controllers;
use App\Http\Controllers\AppController;
use Illuminate\Http\Request;
use App\Models\Content;
use Illuminate¥Support¥Facades¥DB;

class ContentController extends AppController
{
	
	// 当画面バージョン (バージョンを変更すると画面に新バージョン通知とクリアボタンが表示されます。）
	public $this_page_version = '1.0.0';
	
	private $cb; // CrudBase制御クラス
	private $md; // モデル
	
	private $login_needed_flg = false; // ログイン必須フラグ（編集系で認証を必須とするか？）

	
	/**
	 * コンテンツCRUDページ
	 */
	public function index(){
		

		$this->init();

 		// CrudBase共通処理（前）
 		$crudBaseData = $this->cb->indexBefore();//indexアクションの共通先処理(CrudBaseController)
 		
 		$userInfo = $this->getUserInfo();
		$crudBaseData['userInfo'] = $userInfo;
 		// CBBXS-2019

 		// CBBXE
		
		//一覧データを取得
		$res = $this->md->getData($crudBaseData);
		$data = $res['data'];
		$non_limit_count = $res['non_limit_count']; // LIMIT制限なし・データ件数

		// CrudBase共通処理（後）
		$crudBaseData = $this->cb->indexAfter($crudBaseData, ['non_limit_count'=>$non_limit_count]);
		
		$masters = []; // マスターリスト群
		
		// CBBXS-2020

		// ページIDリスト
		$pageIdList = $this->md->getPageIdList();
		$masters['pageIdList'] = $pageIdList;

		// 画像タイプフラグリスト
		$imgFlgList = $this->md->getImgFlgList();
		$masters['imgFlgList'] = $imgFlgList;

		// CBBXE

		$crudBaseData['masters'] = $masters;
		
		$crud_base_json = json_encode($crudBaseData,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
		return view('content.index', compact('data', 'crudBaseData', 'crud_base_json'));
		
		
	}
	
	
	/**
	 * DB登録
	 *
	 * @note
	 * Ajaxによる登録。
	 * 編集登録と新規入力登録の両方に対応している。
	 */
	public function ajax_reg(){
		
		$this->init();
		
		$errs = []; // エラーリスト
		
		if(\Auth::id() == null && $this->login_needed_flg == true){
			return 'Error:ログイン認証が必要です。 Login is needed';
		}
		
		// JSON文字列をパースしてエンティティを取得する
		$json=$_POST['key1'];
		$ent = json_decode($json, true);
		
		// 登録パラメータ
		$reg_param_json = $_POST['reg_param_json'];
		$regParam = json_decode($reg_param_json,true);
		$form_type = $regParam['form_type']; // フォーム種別 new_inp,edit,delete,eliminate

		// CBBXS-2024
		$ent['img_fp'] = $this->cb->makeFilePath($_FILES, 'rsc/img/%field/y%Y/m%m/orig/%Y%m%d%H%i%s_%fn', $ent, 'img_fp');

		// CBBXE
		
		$ent = $this->md->saveEntity($ent, $regParam);
		
		
		
		// ファイルアップロードとファイル名のDB保存
		if(!empty($_FILES)){
			// CBBXS-2027
			$img_fp = $this->cb->makeFilePath($_FILES, "storage/Content/y%Y/{$ent['id']}/%unique/orig/%fn", $ent, 'img_fp');
			$fileUploadK = $this->factoryFileUploadK();
			
			// ▼旧ファイルを指定ディレクトリごと削除する。
			$ary = explode("/", $img_fp);
			$ary = array_slice($ary, 0, 4);
			$del_dp = implode('/', $ary);
 			$fileUploadK->removeDirectory($del_dp); // 旧ファイルを指定ディレクトリごと削除
 			
 			// ファイル配置＆DB保存
			$fileUploadK->putFile1($_FILES, 'img_fp', $img_fp);
			$ent['img_fp'] = $img_fp;
			$this->md->save($ent, ['validate'=>false]);

			// CBBXE
		}
		
		
		$json_str = json_encode($ent, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS); // JSONに変換
		
		return $json_str;
		
	}
	
	
	/**
	 * 削除登録
	 *
	 * @note
	 * Ajaxによる削除登録。
	 * 削除更新でだけでなく有効化に対応している。
	 * また、DBから実際に削除する抹消にも対応している。
	 */
	public function ajax_delete(){

		$this->init();

		if(\Auth::id() == null && $this->login_needed_flg == true){
			return 'Error:ログイン認証が必要です。 Login is needed';
		}
		
		// JSON文字列をパースしてエンティティを取得する
		$json=$_POST['key1'];
		$ent0 = json_decode($json,true);
		
		
		// 登録パラメータ
		$reg_param_json = $_POST['reg_param_json'];
		$regParam = json_decode($reg_param_json,true);
		
		// 抹消フラグ
		$eliminate_flg = 0;
		if(isset($regParam['eliminate_flg'])) $eliminate_flg = $regParam['eliminate_flg'];
		
		// 削除用のエンティティを取得する
		$ent = $this->cb->getEntForDelete($ent0['id']);
		$ent['delete_flg'] = $ent0['delete_flg'];
		
		// エンティティをDB保存
		if($eliminate_flg == 0){
			$ent = $this->md->saveEntity($ent,$regParam); // 更新
		}else{
			
			// CBBXS-2026
 			$this->cb->eliminateFiles($ent['id'], 'img_fp', $ent); // ファイル抹消（他のレコードが保持しているファイルは抹消対象外）

 			// CBBXE
 			
 			$this->cb->delete($ent['id']); // idに紐づくレコードをDB削除
		}
		
		$json_str =json_encode($ent);//JSONに変換
		
 		return $json_str;
	}
	
	
	/**
	 * Ajax | 自動保存
	 *
	 * @note
	 * バリデーション機能は備えていない
	 *
	 */
	public function auto_save(){
		
		$this->init();
		
		if(\Auth::id() == null && $this->login_needed_flg == true){
			return 'Error:ログイン認証が必要です。 Login is needed';
		}
		
		$json=$_POST['key1'];
		
		$data = json_decode($json,true);//JSON文字を配列に戻す
		
		// データ保存
		$this->cb->begin();
		$this->cb->saveAll($data); // まとめて保存。内部でSQLサニタイズされる。
		$this->cb->commit();
		
		$res = ['success'];
		
		$json_str = json_encode($res);//JSONに変換
		
		return $json_str;
	}
	
	
	/**
	 * ファイルアップロードクラスのファクトリーメソッド
	 * @return \App\Http\Controllers\FileUploadK
	 */
	private function factoryFileUploadK(){
		$crud_base_path = CRUD_BASE_PATH;
		require_once $crud_base_path . 'FileUploadK/FileUploadK.php';
		$fileUploadK = new \FileUploadK();
		return $fileUploadK;
	}
	
	
	/**
	 * CrudBase用の初期化処理
	 *
	 * @note
	 * フィールド関連の定義をする。
	 *
	 */
	private function init(){
		
		
		
		/// 検索条件情報の定義
		$kensakuJoken=[
				
				['name'=>'kj_main', 'def'=>null],
				// CBBXS-2000
				['name'=>'kj_id', 'def'=>null],
				['name'=>'kj_page_id', 'def'=>null],
				['name'=>'kj_code', 'def'=>null],
				['name'=>'kj_content_name', 'def'=>null],
				['name'=>'kj_text1', 'def'=>null],
				['name'=>'kj_midasi1', 'def'=>null],
				['name'=>'kj_img_flg', 'def'=>null],
				['name'=>'kj_img_fp', 'def'=>null],
				['name'=>'kj_img_id', 'def'=>null],
				['name'=>'kj_sort_no', 'def'=>null],
				['name'=>'kj_delete_flg', 'def'=>0],
				['name'=>'kj_update_user', 'def'=>null],
				['name'=>'kj_ip_addr', 'def'=>null],
				['name'=>'kj_created', 'def'=>null],
				['name'=>'kj_modified', 'def'=>null],

				// CBBXE
				
				['name'=>'row_limit', 'def'=>50],
				
		];
		
		
		///フィールドデータ
		$fieldData = ['def'=>[
				
				// CBBXS-2002
			'id'=>[
					'name'=>'ID',//HTMLテーブルの列名
					'row_order'=>'Content.id',//SQLでの並び替えコード
					'clm_show'=>1,//デフォルト列表示 0:非表示 1:表示
			],
			'page_id'=>[
					'name'=>'ページID',
					'row_order'=>'Content.page_id',
					'clm_show'=>1,
			],
			'code'=>[
					'name'=>'コード',
					'row_order'=>'Content.code',
					'clm_show'=>1,
			],
			'content_name'=>[
					'name'=>'コンテンツ名',
					'row_order'=>'Content.content_name',
					'clm_show'=>1,
			],
			'text1'=>[
					'name'=>'テキスト1',
					'row_order'=>'Content.text1',
					'clm_show'=>1,
			],
			'midasi1'=>[
					'name'=>'見出し1',
					'row_order'=>'Content.midasi1',
					'clm_show'=>1,
			],
			'img_flg'=>[
					'name'=>'画像タイプフラグ',
					'row_order'=>'Content.img_flg',
					'clm_show'=>1,
			],
			'img_fp'=>[
					'name'=>'画像ファイルパス',
					'row_order'=>'Content.img_fp',
					'clm_show'=>1,
			],
			'img_id'=>[
					'name'=>'画像ファイルID',
					'row_order'=>'Content.img_id',
					'clm_show'=>1,
					'outer_tbl_name'=>'imgs',
					'outer_tbl_name_c'=>'Img',
					'outer_field'=>'img_name',
					'outer_alias'=>'img_name',
			],
			'sort_no'=>[
					'name'=>'順番',
					'row_order'=>'Content.sort_no',
					'clm_show'=>0,
			],
			'delete_flg'=>[
					'name'=>'無効フラグ',
					'row_order'=>'Content.delete_flg',
					'clm_show'=>0,
			],
			'update_user'=>[
					'name'=>'更新者',
					'row_order'=>'Content.update_user',
					'clm_show'=>0,
			],
			'ip_addr'=>[
					'name'=>'IPアドレス',
					'row_order'=>'Content.ip_addr',
					'clm_show'=>0,
			],
			'created'=>[
					'name'=>'生成日時',
					'row_order'=>'Content.created',
					'clm_show'=>0,
			],
			'modified'=>[
					'name'=>'更新日',
					'row_order'=>'Content.modified',
					'clm_show'=>0,
			],

				// CBBXE
		]];
		
		// 列並び順をセットする
		$clm_sort_no = 0;
		foreach ($fieldData['def'] as &$fEnt){
			$fEnt['clm_sort_no'] = $clm_sort_no;
			$clm_sort_no ++;
		}
		unset($fEnt);
		
		
		$crud_base_path = CRUD_BASE_PATH;
		$crud_base_js = CRUD_BASE_JS;
		$crud_base_css = CRUD_BASE_CSS;
		require_once $crud_base_path . 'CrudBaseController.php';
		
		$model = new Content(); // モデルクラス
		
		$crudBaseData = [
				'fw_type' => 'laravel7',
				'model_name_c' => 'Content',
				'tbl_name' => 'contents', // テーブル名をセット
				'kensakuJoken' => $kensakuJoken, //検索条件情報
				'fieldData' => $fieldData, //フィールドデータ
				'crud_base_path' => $crud_base_path,
				'crud_base_js' => $crud_base_js,
				'crud_base_css' => $crud_base_css,
		];
		
		$crudBaseCon = new \CrudBaseController($this, $model, $crudBaseData);
		
		$model->init($crudBaseCon);
		
		$this->md = $model;
		$this->cb =$crudBaseCon;
		
		$crudBaseData = $crudBaseCon->getCrudBaseData();
		return $crudBaseData;
		
	}

	/**
	 * AJAX | 一覧のチェックボックス複数選択による一括処理
	 * @return string
	 */
	public function ajax_pwms(){
		$this->init();
		return $this->cb->ajax_pwms();
	}

	
	/**
	 * CSVダウンロード
	 *
	 * 一覧画面のCSVダウンロードボタンを押したとき、一覧データをCSVファイルとしてダウンロードします。
	 */
	public function csv_download(){
		$this->init();
		
		//ダウンロード用のデータを取得する。
		$data = $this->getDataForDownload();
		
		// ダブルクォートで値を囲む
		foreach($data as &$ent){
			unset($ent['xml_text']);
			foreach($ent as $field => $value){
				if(mb_strpos($value,'"')!==false){
					$value = str_replace('"', '""', $value);
				}
				$value = '"' . $value . '"';
				$ent[$field] = $value;
			}
		}
		unset($ent);
		
		//列名配列を取得
		$clms=array_keys($data[0]);
		
		//データの先頭行に列名配列を挿入
		array_unshift($data,$clms);
		
		
		//CSVファイル名を作成
		$date = new \DateTime();
		$strDate=$date->format("Y-m-d");
		$fn='content'.$strDate.'.csv';
		
		
		//CSVダウンロード
		$crud_base_path = CRUD_BASE_PATH;
		require_once $crud_base_path . 'CsvDownloader.php';
		$csv= new \CsvDownloader();
		$csv->output($fn, $data);

	}

	
	//ダウンロード用のデータを取得する。
	private function getDataForDownload(){
		
		//セッションから検索条件情報を取得
		$kjs=session('content_kjs');

		// セッションからページネーション情報を取得
		$pages = session('content_pages');
		
		$page_no = 0;
		$row_limit = 100000;
		$sort_field = $pages['sort_field'];
		$sort_desc = $pages['sort_desc'];
		
		$crudBaseData = [
				'kjs' => $kjs,
				'pages' => $pages,
				'page_no' => $page_no,
				'row_limit' => $row_limit,
				'sort_field' => $sort_field,
				'sort_desc' => $sort_desc,
		];
		
		
		//DBからデータ取得
		$res = $this->md->getData($crudBaseData);
		$data = $res['data'];
		if(empty($data)){
			return [];
		}
		
		return $data;
	}
	
	
	/**
	 * 一括登録 | AJAX
	 *
	 * @note
	 * 一括追加, 一括編集, 一括複製
	 */
	public function bulk_reg(){
		$this->init();
		
		$crud_base_path = CRUD_BASE_PATH;
		require_once $crud_base_path . 'BulkReg.php';
		
		// 更新ユーザーを取得
		$update_user = 'none';
		if(\Auth::id()){// idは未ログインである場合、nullになる。
			$user_id = \Auth::id(); // ユーザーID（番号）
			$update_user = \Auth::user()->name; // ユーザー名
		}else{
			throw new Exception('Login is needed. ログインが必要です。');
			die();
		}
		
		$json_param=$_POST['key1'];
		$param = json_decode($json_param,true);//JSON文字を配列に戻す
		
		// 一括登録
		$strategy = $this->cb->getStrategy(); // フレームワークストラテジーを取得する
		$bulkReg = new \BulkReg($strategy, $update_user);
		$res = $bulkReg->reg('contents', $param);
		
		//JSONに変換
		$str_json = json_encode($res,JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS);
		
		return $str_json;
	}
	
	
}


