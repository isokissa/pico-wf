
echo "First test the framework with stubs:"
phpunit --verbose --bootstrap unit-test/pico-wf/InitStub.php unit-test/pico-wf/

echo
echo "Now test with FileSystemBackend:"
phpunit --verbose --bootstrap unit-test/pico-wf/InitFileSystemBackend.php --include-path site/ --configuration pico-wf.phpunit.xml
