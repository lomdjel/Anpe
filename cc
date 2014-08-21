rm -fr app/logs/*
rm -fr app/cache/*
mkdir -p app/cache/dev/annotations
touch app/logs/dev.log
chmod -R 777 app/cache
chmod -R 777 app/logs

