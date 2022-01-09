#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz  ../crud_base_config_p.php amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/crud_base_config.php

echo "------------ 送信完了"
cmd /k