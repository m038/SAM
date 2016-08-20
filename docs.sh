git checkout master ;
echo "\nCopying: src -> .src\n" ;
cp -r src .src ;
git checkout docs ;
echo "\nMoving: .src -> src\n" ;
mv .src src ;
if [ ! -f sami.phar ]; then
	echo "\nDownloading: http://get.sensiolabs.org/sami.phar\n" ;
	wget http://get.sensiolabs.org/sami.phar ;
fi
php sami.phar update samicfg.php ;
echo "\nRemoving: cache\n" ;
rm -r cache ;
echo "\nRemoving: src\n" ;
rm -r src ;