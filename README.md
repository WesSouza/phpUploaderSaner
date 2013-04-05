# phpUploaderSaner: Putting order to $_FILES

If you ever used file upload on PHP to handle multiple files in a complex
hierarchy, or even more than one file using the simple foo[] notation, you know
that PHP has a weird way of structuring the $_FILES variable.

This is what it produces:

    foo
     |- name
     |  '- 0
     |     '- myFile.php
     |- type
     |  '- 0
     |     '- text/php
     |- size
     |  '- 0
     |     '- 21341
     |- tmp_name
     |  '- 0
     |     '- /tmp/phpSaner
     '- error
        '- 0
           '- 0

With only 2 loops per file, **phpUploaderSaner** produces:

    foo
     '- 0
        |- name = myFile.php
        |- type = text/php
        |- size = 21341
        |- tmp_name =/tmp/phpSaner
        '- error = 0

It makes more sense, is very straightforward, and doesn't use too much
resources.


### Usage

```php
// Method 1
// Returns the phpUploaderSaner structured files array for the given $_FILES
$myFiles = phpUploaderSaner::parse( $_FILES );

// Method 2
// Replaces the original $_FILES structure with phpUploaderSaner approach
phpUploaderSaner::replaceNative();
```


### License

phpUploaderSaner is licensed under the [Apache License, Version 2.0]
(http://www.apache.org/licenses/LICENSE-2.0.html).