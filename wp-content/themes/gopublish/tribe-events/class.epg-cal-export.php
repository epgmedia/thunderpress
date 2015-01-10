<?php
/**
 * Class: EPG File Export.
 *
 * Class will create the export script for pulling events from the Thunder Press
 * calendar.
 *
 * Final product will incorporate notes from Cristy on needs as best as possible.
 */

if ( ! class_exists( 'epg_cal_export' ) ) {

    /**
     * # Checklist
     *
     * ## Export Options
     *
     * 1. Region(s) - Option to choose multiple
     * 2. Date Ranges (Importantly, start date)
     * 3. Non-Recurring or only single-instance recurring
     *
     * ## Fields
     *
     * 1. Title
     * 2. Short Description
     * 3. Date / Times
     * 4. Address
     * 5. Region
     *
     */

    class epg_cal_export {

		public $args;

		/**
		 * @var $events TribeEventsQuery object new Events Query
		 */
		private $events;

        /**
        * Create new Tribe Events query on instantiation
        */
        public function __construct( TribeEventsQuery $events ) {
            $this->events = $events;
        }

        public function get_events( $args ) {

            return $this->events->getEvents( $args );
        }

    }

}

$export = new epg_cal_export();

$args = array (
	'post_status'            => 'published',
	'pagination'             => false,
	'year'                   => '2014',
	'monthnum'               => '10',
);

$events = $export->get_events( $args );
