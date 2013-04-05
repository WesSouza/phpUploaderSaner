<?php
/**
 * Copyright 2013 Wesley de Souza
 * 
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * 
 *    http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Provides a saner, more logical way of reading $_FILES, by shifting the name,
 * type, size, tmp_name and error keys to the last level in the array, instead
 * of having them at the second level.
 * 
 * This class returns an array or reconstructs $_FILES in order to organize its
 * hierarchy in a more logical way. Currently, file upload with arrays of
 * multiple levels on PHP are structured in a very specific way. This class
 * would transform:
 * 
 *   foo
 *    |- name
 *    |  '- 0
 *    |     '- myFile.php
 *    |- type
 *    |  '- 0
 *    |     '- text/php
 *    |- size
 *    |  '- 0
 *    |     '- 21341
 *    |- tmp_name
 *    |  '- 0
 *    |     '- /tmp/phpSaner
 *    '- error
 *       '- 0
 *          '- 0
 * 
 * Into:
 * 
 *   foo
 *    '- 0
 *       |- name = myFile.php
 *       |- type = text/php
 *       |- size = 21341
 *       |- tmp_name =/tmp/phpSaner
 *       '- error = 0
 * 
 * Much easier to walk through.
 * 
 * @author Wesley de Souza <pus-oss@wesleydesouza.com.br>
 * @version 1.0
 */
class phpUploadSaner
{
	/**
	 * Parses the given $_FILES variable, and if it has deeper levels,
	 * normalizes it into the more logical way.
	 * 
	 * @param  array $files $_FILES array
	 * @return array        Normalized files array
	 */
	public static function parse ( $files )
	{
		$return = array();
		foreach ( $files as $fieldName => $file )
		{
			if ( is_array( $file["name"] ) )
			{
				$return[ $fieldName ] = array();
				self::filesCrawler( $file["name"], $file["type"], $file["size"], $file["tmp_name"], $file["error"], $return[ $fieldName ] );
			}
			else
				$return[ $fieldName ] = $file;
		}
		return $return;
	}
	
	/**
	 * Helper crawler created to walk the all simultaneous arrays in order to
	 * allow the procedure to reach every file property while constructing the
	 * path on the final array, by reference.
	 * 
	 * @param array $names     Names array
	 * @param array $types     Types array
	 * @param array $sizes     Sizes array
	 * @param array $tmp_names Temporary names array
	 * @param array $errors    Errors array
	 * @param array $result    Result array
	 */
	private static function filesCrawler ( $names, $types, $sizes, $tmp_names, $errors, & $result )
	{
		if ( is_array( $names ) )
		{
			foreach ( $names as $next => $whatever )
				self::filesCrawler( $names[ $next ], $types[ $next ], $sizes[ $next ], $tmp_names[ $next ], $errors[ $next ], $result[ $next ] );
		}
		else
			$result = array( "name" => $names, "type" => $types, "size" => $sizes, "tmp_name" => $tmp_names, "error" => $errors );
	}
	
	/**
	 * Replaces the native $_FILES with its sane version.
	 */
	public static function replaceNative ( )
	{
		$_FILES = self::parse( $_FILES );
	}
}
