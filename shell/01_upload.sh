#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz --exclude='wp-config.php' ../ amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/

echo "------------ 送信完了"
cmd /k