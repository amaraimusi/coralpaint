<?php
/**
 * WordPress の基本設定
 *
 * このファイルは、インストール時に wp-config.php 作成ウィザードが利用します。
 * ウィザードを介さずにこのファイルを "wp-config.php" という名前でコピーして
 * 直接編集して値を入力してもかまいません。
 *
 * このファイルは、以下の設定を含みます。
 *
 * * MySQL 設定
 * * 秘密鍵
 * * データベーステーブル接頭辞
 * * ABSPATH
 *
 * @link https://ja.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// 注意:
// Windows の "メモ帳" でこのファイルを編集しないでください !
// 問題なく使えるテキストエディタ
// (http://wpdocs.osdn.jp/%E7%94%A8%E8%AA%9E%E9%9B%86#.E3.83.86.E3.82.AD.E3.82.B9.E3.83.88.E3.82.A8.E3.83.87.E3.82.A3.E3.82.BF 参照)
// を使用し、必ず UTF-8 の BOM なし (UTF-8N) で保存してください。

// ** MySQL 設定 - この情報はホスティング先から入手してください。 ** //
/** WordPress のためのデータベース名 */
define( 'DB_NAME', 'coralpaint' );

/** MySQL データベースのユーザー名 */
define( 'DB_USER', 'root' );

/** MySQL データベースのパスワード */
define( 'DB_PASSWORD', '' );

/** MySQL のホスト名 */
define( 'DB_HOST', 'localhost' );

/** データベースのテーブルを作成する際のデータベースの文字セット */
define( 'DB_CHARSET', 'utf8mb4' );

/** データベースの照合順序 (ほとんどの場合変更する必要はありません) */
define( 'DB_COLLATE', '' );

/**#@+
 * 認証用ユニークキー
 *
 * それぞれを異なるユニーク (一意) な文字列に変更してください。
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org の秘密鍵サービス} で自動生成することもできます。
 * 後でいつでも変更して、既存のすべての cookie を無効にできます。これにより、すべてのユーザーを強制的に再ログインさせることになります。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8a{3jqnCl5+n&S$Eb_c%:qPBoU/sf 1lG;KJYfBF(IR6~/)c?WX=MEQvA_a2C^AJ' );
define( 'SECURE_AUTH_KEY',  ',vX^KgY/USL+H9[YX+y0aD__C1/#Hlbksre_h]/g2&Q|$7n6Zm][Vmyad~^uB8|I' );
define( 'LOGGED_IN_KEY',    '< mbl2QF-_JNO{`%l j. iN1)wGWb rb.v~ZzVk1Q%mK[z|V4C7qm[I8<&ZSn)eB' );
define( 'NONCE_KEY',        'aZhl@t y6%!#H=M_ugr7Rv%sl&s_To|%>lY&}H1Hc##QA!0)]f_&Gnpr*?3F;d8i' );
define( 'AUTH_SALT',        'TOJ$=iJh[1#Zo9j*`SZZN:Lt`d}sa]5I[U!|RVo;Zdrb-rcDC)asY9zW_NUG#R0N' );
define( 'SECURE_AUTH_SALT', '#-S<nfq;24ReV>$]1$qp:[WHt3*pj74iglvp|fOc%T?>9Eg$mr%(@vvn|a<fu0qQ' );
define( 'LOGGED_IN_SALT',   'h(LR+khUy3;Q*!GUIXm72Zl/r ;HW!;0=JhZla+{87j^Tgm]V|Q&Tu7xys].;6 u' );
define( 'NONCE_SALT',       'Qp#wS6gdv8rKly&@#!rhW+/ll<%p4l0|l?Wq#wyLPvV2{=D|3M$z-*8$,w- fB}2' );

/**#@-*/

/**
 * WordPress データベーステーブルの接頭辞
 *
 * それぞれにユニーク (一意) な接頭辞を与えることで一つのデータベースに複数の WordPress を
 * インストールすることができます。半角英数字と下線のみを使用してください。
 */
$table_prefix = 'wp_';

/**
 * 開発者へ: WordPress デバッグモード
 *
 * この値を true にすると、開発中に注意 (notice) を表示します。
 * テーマおよびプラグインの開発者には、その開発環境においてこの WP_DEBUG を使用することを強く推奨します。
 *
 * その他のデバッグに利用できる定数についてはドキュメンテーションをご覧ください。
 *
 * @link https://ja.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* カスタム値は、この行と「編集が必要なのはここまでです」の行の間に追加してください。 */



/* 編集が必要なのはここまでです ! WordPress でのパブリッシングをお楽しみください。 */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
