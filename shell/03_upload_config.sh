﻿#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz  ../amaraimusi/crud_base_config.php amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/

echo "------------ 送信完了"
cmd /k