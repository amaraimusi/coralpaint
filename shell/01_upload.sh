#!/bin/sh
echo 'ソースコードを差分アップロードします。'

rsync -auvz ../controller amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../css amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../fonts amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../img amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../js amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../model amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../rsc amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/
rsync -auvz ../crud_base_config_p.php amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/crud_base_config.php
rsync -auvz ../index.php amaraimusi@amaraimusi.sakura.ne.jp:www/coralpaint/

echo "------------ 送信完了"
#cmd /k