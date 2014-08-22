<?php
/**
 * This is a simple class for managing file write methods.
 *
 * It will handle validation for certain functions while writing a new file.
 */


if ( ! class_exists( 'epg_file' ) ) {

	/**
	 * To Do:
	 *
	 * ----1. Function for creating file
	 * ----2. Function for appending to file
	 * ----3. Function for deleting file
	 * 4. Function for getting contents
	 * 5. Function for deleting contents
	 */

    class epg_file {

		/**
		 * fopen() modes
		 *
		 * 'r' = Read
		 * 'w' = Write
		 * 'a' = Append
		 * 'x' = Write, only if new file
		 * 'c' = Write, overwrite only on special cases
		 */
		const READ   = 'r';
		const WRITE  = 'w';
		const APPEND = 'a';

		/**
		 * @var null|string Directory to write
		 */
		public $dir;

		/**
		 * @var null|array File that was created
		 */
		public $file = array(
			'name'      => null,
			'full_path' => null,
			'size'      => null,
		);

		/**
		 * @var null|array
		 */
		protected $error;

        /**
         * Set these options on creation or set later.
         */
        public function __construct( $name = null, $dir = null ) {

            $this->file['name'] = $name;
            $this->dir          = $dir;

        }

		/**
		 * @param null|string $name   Name of the file to write
		 * @param null|string $dir    File Directory path
		 * @param null|string $string String to write to file
		 *
		 * @return bool
		 */
		public function create_file( $string = null, $name = null, $dir = null ) {

			$filename = $this->get_full_path( $name, $dir );

			$this->file['size'] = $this->file_stream( $filename, self::WRITE, $string );

			return $this->file['size'];
        }

		/**
		 * @param null|string $string
		 * @param null|string $name
		 * @param null|string $dir
		 *
		 * @return int|bool
		 */
		public function append_string( $string = null, $name = null, $dir = null ) {

			$filename = $this->get_full_path( $name, $dir );

			$this->file['size'] = $this->file_stream( $filename, self::APPEND, $string );

			return $this->file['size'];
        }

		/**
		 * @param null|string $name
		 * @param null|string $dir
		 *
		 * @return bool
		 */
		public function delete_file( $name = null, $dir = null ) {

			$filename = $this->get_full_path( $name, $dir );

			return $this->unlink_file( $filename );
        }

        public function get_contents( $name ) {

        }

        public function delete_contents( $name ) {

        }

		/**
		 * @param null|string $name Filename
		 * @param null|string $dir  Directory
		 *
		 * @return null|string Full path to file
		 */
		private function get_full_path( $name = null, $dir = null ) {

			if ( $this->file['full_path'] === null ) {

				// Get the name to be created
				if ( $name === null ) {
					$name = $this->file['name'];
				}

				// Get the directory to create it in
				if ( $dir === null ) {
					$dir = $this->dir;
				}

				// If we don't have anything, return false
				if ( $name === null && $dir === null ) {

					$this->error( "No filename or directory", __LINE__, __METHOD__ );

					return null;
				}

				// Check for preceding slash, and add it
				if ( substr( $name, 0, 1 ) !== '/' ) {
					$name = '/' . $name;
				}

				// Check for trailing slash and remove it
				if ( substr( $dir, -1 ) === '/' ) {
					$dir = substr( $dir, 0, -1 );
				}

				$this->file['full_path'] = $dir . $name;
			}

			// Return the filename
			return $this->file['full_path'];
        }

		/**
		 * @param string      $filename Path to file to write
		 * @param string      $action   Action to perform
		 * @param null|string $string   String to add to file
		 *
		 * @return int|null File size if successful, null if nothing
		 */
		private function file_stream( $filename, $action, $string = null ) {

			if ( is_writable( $filename ) ) {

				//Check if the file was created
				if ( !$handle = fopen( $filename , $action ) ) {

					$this->error( 'File was not opened', __LINE__, __METHOD__ );

					return NULL;
				}

				// Write data to new stylesheet.
				if ( fwrite( $handle, $string ) === FALSE ) {

					$this->error( 'Could not write data', __LINE__, __METHOD__ );

					return NULL;
				}

				// Success, wrote data to file new stylesheet;
				fclose($handle);

				return ( file_exists( $filename ) ? filesize( $filename ) : NULL );
			} else {

				$this->error( 'File was not writable', __LINE__, __METHOD__ );

				return NULL;
			}

		}

		/**
		 * @param string $filename
		 *
		 * @return bool
		 */
		private function unlink_file( $filename ) {

			if ( file_exists( $filename ) ) {

				return unlink( $filename );
			}

			$this->error( "{$filename} does not exist", __LINE__, __METHOD__ );

			return FALSE;

		}

		/**
		 * @param string $string
		 * @param int    $line
		 * @param string $method
		 */
		protected function error( $string, $line, $method ) {
			$this->error[] = array(
				'Error'  => $string,
				'Line'   => $line,
				'Method' => $method
			);
		}

		/**
		 * @return array|null
		 */
		public function get_errors() {

			return $this->error;
		}

    }

}