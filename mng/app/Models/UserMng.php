<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMng extends Model
{
	protected $table = 'users'; // 紐づけるテーブル名
	//protected $guarded = ['id']; // 予期せぬ代入をガード。 通常、主キーフィールドや、パスワードフィールドなどが指定される。
	
	// ホワイトリスト（DB保存時にこのホワイトリストでフィルタリングが施される）
	public $fillable = [
			// CBBXS-2009
			'id',
			'name',
			'email',
			'role',
			'sort_no',
			'delete_flg',

			// CBBXE
	];
	
	// CBBXS-2012

	// CBBXE
	
	//public $timestamps = false; // タイムスタンプ。 trueならcreated_atフィールド、updated_atフィールドに適用される。（それ以外のフィールドを設定で指定可）
	
	
	private $cb; // CrudBase制御クラス
	
	
	public function __construct(){
		
	}
	
	
	/**
	 * 初期化
	 * @param CrudBaseController $cb
	 */
	public function init($cb){
		$this->cb = $cb;
		
		// ホワイトリストをセット
		$cbParam = $this->cb->getCrudBaseData();
		$fields = $cbParam['fields'];
		$this->fillable = $fields;
	}
	
	/**
	 * 検索条件とページ情報を元にDBからデータを取得する
	 * @param array $crudBaseData
	 * @return number[]|unknown[]
	 *  - array data データ
	 *  - int non_limit_count LIMIT制限なし・データ件数
	 */
	public function getData($crudBaseData){
		
		$fields = $crudBaseData['fields']; // フィールド
		
		$kjs = $crudBaseData['kjs'];//検索条件情報
		$pages = $crudBaseData['pages'];//ページネーション情報

		$page_no = $pages['page_no']; // ページ番号
		$row_limit = $pages['row_limit']; // 表示件数
		$sort_field = $pages['sort_field']; // ソートフィールド
		$sort_desc = $pages['sort_desc']; // ソートタイプ 0:昇順 , 1:降順
		
		//条件を作成
 		$conditions=$this->createKjConditions($kjs);
		
		// オフセットの組み立て
		$offset=null;
		if(!empty($row_limit)) $offset = $page_no * $row_limit;
		
		// ORDER文の組み立て
		$order = $sort_field;
		if(empty($order)) $order='sort_no';
		
		$order_option = 'asc';
		if(!empty($sort_desc)) $order_option = 'desc';
		
		$str_fields = implode(",", $fields);

		$query = \DB::table('users as UserMng');
		$query->selectRaw('SQL_CALC_FOUND_ROWS ' . $str_fields);
		if(!empty($conditions)) $query->whereRaw($conditions);
		if(!empty($offset)) $query->offset($offset);
		if(!empty($row_limit)) $query->limit($row_limit);
		if(!empty($order)) $query->orderBy($order, $order_option);
		$data = $query->get();
		
		
		// LIMIT制限なし・データ件数
		$non_limit_count = 0;
		$res = \DB::select('SELECT FOUND_ROWS()');
		if(!empty($res)){
			$non_limit_count = reset($res[0]);
		}
		
		// 構造変換
		$data2 = [];
		foreach($data as $ent){
			$data2[] = (array)$ent;
		}

		return ['data' => $data2, 'non_limit_count' => $non_limit_count];
		
	}
	
	
	/**
	 * 検索条件情報からWHERE情報を作成。
	 * @param array $kjs	検索条件情報
	 * @return string WHERE情報
	 */
	private function createKjConditions($kjs){

		$cnds=null;
		
		$kjs = $this->cb->xssSanitizeW($kjs); // SQLサニタイズ
		
		if(!empty($kjs['kj_main'])){
			$cnds[]="CONCAT( IFNULL(UserMng.user_mng_name, '') ,IFNULL(UserMng.note, '')) LIKE '%{$kjs['kj_main']}%'";
		}
		
		// CBBXS-1003
		if(!empty($kjs['kj_id']) || $kjs['kj_id'] ==='0' || $kjs['kj_id'] ===0){
			$cnds[]="UserMng.id = {$kjs['kj_id']}";
		}
		if(!empty($kjs['kj_name'])){
			$cnds[]="UserMng.name LIKE '%{$kjs['kj_name']}%'";
		}
		if(!empty($kjs['kj_email'])){
			$cnds[]="UserMng.email LIKE '%{$kjs['kj_email']}%'";
		}
		if(!empty($kjs['kj_role']) || $kjs['kj_role'] ==='0' || $kjs['kj_role'] ===0){
			$cnds[]="UserMng.role = {$kjs['kj_role']}";
		}
		if(!empty($kjs['permRoles'])){
			$perm_roles_c = "'" . implode("','", $kjs['permRoles']) . "'";
			$cnds[]="UserMng.role IN({$perm_roles_c})";
		}else{
			$cnds[]="UserMng.role ='empty'";
		}
		if(!empty($kjs['kj_sort_no']) || $kjs['kj_sort_no'] ==='0' || $kjs['kj_sort_no'] ===0){
			$cnds[]="UserMng.sort_no = {$kjs['kj_sort_no']}";
		}
		$kj_delete_flg = $kjs['kj_delete_flg'];
		if(!empty($kjs['kj_delete_flg']) || $kjs['kj_delete_flg'] ==='0' || $kjs['kj_delete_flg'] ===0){
			if($kjs['kj_delete_flg'] != -1){
			   $cnds[]="UserMng.delete_flg = {$kjs['kj_delete_flg']}";
			}
		}

		// CBBXE
		
		$cnd=null;
		if(!empty($cnds)){
			$cnd=implode(' AND ',$cnds);
		}
		
		return $cnd;
		
	}
	
	
	/**
	 * トランザクション・スタート
	 */
	public function begin(){
		$this->cb->begin();
	}
	
	/**
	 * トランザクション・ロールバック
	 */
	public function rollback(){
		$this->cb->rollback();
	}
	
	/**
	 * トランザクション・コミット
	 */
	public function commit(){
		$this->cb->commit();
	}
	
	
	// CBBXS-2021
	/**
	 * 権限リストをDBから取得する
	 */
	public function getRoleList(){

		// DBからデータを取得
		$query = \DB::table('roles')->
		whereRaw("delete_flg = 0")->
		orderBy('sort_no', 'ASC');
		$data = $query->get();

		// リスト変換
		$list = [];
		foreach($data as $ent){
			$ent = (array)$ent;
			$id = $ent['id'];
			$name = $ent['role_name'];
			$list[$id] = $name;
		}

		return $list;
		
	}

	// CBBXE
	
	
	
	/**
	 * エンティティのDB保存
	 * @param [] $ent エンティティ
	 * @param [] DB保存パラメータ
	 *  - form_type フォーム種別  new_inp:新規入力 edit:編集 delete:削除
	 *  - ni_tr_place 新規入力追加場所フラグ 0:末尾(デフォルト） , 1:先頭
	 *  - tbl_name DBテーブル名
	 * @return [] エンティティ(insertされた場合、新idがセットされている）
	 */
	public function saveEntity(&$ent, &$regParam){
		
		
		return $this->cb->saveEntity($ent, $regParam);
		

	}
	
	
	
	/**
	 * データのDB保存
	 * @param [] $data データ（エンティティの配列）
	 * @return [] データ(insertされた場合、新idがセットされている）
	 */
	public function saveAll(&$data){
		return $this->cb->saveAll($data);
	}
	
	
	/**
	 * 複数レコードのINSERT
	 * @param [] $data データ（エンティティの配列）
	 */
	public function insertAll($data){
		
		if(empty($data)) return;
		
		foreach($data as &$ent){
			$ent = array_intersect_key($ent, array_flip($this->fillable));
			unset($ent['id']);
		}
		unset($ent);

		$this->insert($data);
		
		
	}
	
	
	
	
	
	
}
