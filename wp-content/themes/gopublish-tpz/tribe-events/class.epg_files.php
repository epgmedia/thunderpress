<?php
/**
 * This is a simple class for managing file write methods.
 *
 * It will handle validation for certain functions while writing a new file.
 */

if ( ! class_exists( 'epg_files' ) ) {

    class epg_files {

        /**
         * Name of the file to be worked with
         */
        public $name;

        /**
         * Directory to write
         */
        public $dir;

        /**
         * Set these options on creation or set later.
         */
        public function __construct( $name = null, $dir = null ) {

            $this->name = $name;
            $this->dir  = $dir;

        }

        /**
         * To Do:
         *
         * 1. Function for creating file
         * 2. Function for appending to file
         * 3. Function for deleting file
         * 4. Function for getting contents
         * 5. Function for deleting contents
         */
        public function create_file( $name, $string = null ) {

            $full_name = $this->dir . '/' . $name;

            if ( is_writable( $full_name ) {

                // Check if the file was created
                if ( ! $handle = fopen( $full_name , 'w' ) ) {

                    return FALSE;
                }

                // Write data to new stylesheet.
                if ( fwrite( $handle, $string ) === FALSE) {

                    return FALSE;
                }

                // Success, wrote data to file new stylesheet;
                fclose($handle);

                return TRUE;

            } else {

                return FALSE;
            }

        }

        public function append_string( $string, $file ) {

        }

        public function delete_file( $name ) {

        }

        public function get_contents( $name ) {

        }

        public function delete_contents( $name ) {

        }

        protected function get_full_path( $name, $dir ) {

        }

    }

}
