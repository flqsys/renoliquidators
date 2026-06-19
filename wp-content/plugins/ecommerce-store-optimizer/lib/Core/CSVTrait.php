<?php
/**
 * CSV Trait
 *
 * Helpful methods for working with CSVs.
 *
 * @since 0.4.0
 * @package ecommerce-store-optimizer
 */

declare(strict_types=1);

namespace Genesis\EcommerceStoreOptimizer\Core;

trait CSVTrait {
	/**
	 * Convert a CSV file to an array
	 *
	 * @param string $filename Name of the CSV file.
	 * @param string $delimiter Type of "separator".
	 *
	 * @return mixed bool | array
	 */
	private function csv_to_array( string $filename = '', string $delimiter = ',' ) {

		if ( version_compare( PHP_VERSION, '8.1.0', '<' ) ) {
			ini_set( 'auto_detect_line_endings', 'true' );
		}

		if ( ! file_exists( $filename ) || ! is_readable( $filename ) ) {
			return false;
		}

		$header = null;
		$data   = array();
		if ( ( $handle = fopen( $filename, 'r' ) ) !== false ) { /* phpcs:ignore */
			while ( ( $row = fgetcsv( $handle, 1000, $delimiter ) ) !== false ) { /* phpcs:ignore */
				if ( ! $header ) {
					$header = $row;
				} else {
					if ( count( $header ) > count( $row ) ) {
						$difference = count( $header ) - count( $row );
						for ( $i = 1; $i <= $difference; $i++ ) {
							$row[ count( $row ) + 1 ] = $delimiter;
						}
					}
					$data[] = array_combine( $header, $row );
				}
			}
			fclose( $handle ); /* phpcs:ignore */
		}
		return $data;
	}
}
