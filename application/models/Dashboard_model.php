<?php

class Dashboard_model extends CI_Model

{

	public function __construct()

	{

		parent::__construct();

		

	}

	//get permision by role

	public function get_event_counts()

	{

		$sql='	SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

						p_e.event_id,e.verbose_name, 

				        e.name AS event_name, e.description,

				        ((SELECT COUNT( p.event_id ) AS total_event_count

								FROM personevents p)) AS total_event_count

				FROM personevents p_e

				JOIN EVENTS e ON e.idevent = p_e.event_id

				GROUP BY p_e.event_id';

		$query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}

	}



	//filter events by start date

	 public function filter_events_by_start_date($start_date) {

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

			    p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p WHERE p.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="' )) AS total_event_count FROM personevents p_e JOIN EVENTS e ON e.idevent = p_e.event_id WHERE p_e.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="'	GROUP BY p_e.event_id";

		$query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}

	}



	//filter events by start date

	 public function filter_events_by_end_date($end_date) {

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						 p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p WHERE p.eventdatetime<= '";

		$sql.=$end_date;

		$sql.="' )) AS total_event_count FROM personevents p_e JOIN EVENTS e ON e.idevent = p_e.event_id WHERE p_e.eventdatetime <= '";

		$sql.=$end_date;

		$sql.="'	GROUP BY p_e.event_id";

		$query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}

	}  



	//filter events by start date and end date

	public function filter_events_by_start_date_and_end_date($start_date, $end_date)

	{

		$sql="SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						 p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p WHERE p.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="' AND p.eventdatetime<= '";

		$sql.=$end_date;

		$sql.="' )) AS total_event_count FROM personevents p_e JOIN EVENTS e ON e.idevent = p_e.event_id WHERE p_e.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="' AND p_e.eventdatetime<= '";

		$sql.=$end_date;

		$sql.="'	GROUP BY p_e.event_id";

		$query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}

	} 



	//filter events by facility

	public function filter_events_by_facility($facility){

		$sql="SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode where p.facility_mflcode= ";

		$sql.= $facility;

		$sql.=" )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	FROM personevents p_e ";

		$sql.="	JOIN EVENTS e ON e.idevent = p_e.event_id ";

        $sql.="	JOIN facility f ON f.mflcode = p_e.facility_mflcode";

        $sql.="	WHERE f.mflcode= ";

        $sql.=$facility;

        $sql.=" GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}



	

	//filter events by county 

	public function filter_events_by_county($county) {

		$sql="SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode where fac.county= '";

		$sql.= $county;

		$sql.="'";

		$sql.=" )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	FROM personevents p_e ";

		$sql.="	JOIN EVENTS e ON e.idevent = p_e.event_id ";

        $sql.="	JOIN facility f ON f.mflcode = p_e.facility_mflcode";

        $sql.="	WHERE f.county= '";

        $sql.=$county;

        $sql.="'";

        $sql.=" GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}





	//function to filter events by county and end date

	public function filter_events_by_county_and_end_date($county,$end_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

			    		p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				 FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE fac.county  = '";

		$sql.=	$county;

        $sql.=  "' AND p.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.county= '";                

        $sql.=	$county;

 		$sql.=  "' AND p_e.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}





	//function to filter events by facility and end date

	public function filter_events_by_facility_and_end_date($facility,$end_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE p.facility_mflcode  = ";

		$sql.=	$facility;

        $sql.=  " AND p.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.mflcode= ";                

        $sql.=	$facility;

 		$sql.=  " AND p_e.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}



	//fitler events by facility and start date 

	public function filter_events_by_facility_and_start_date($facility,$start_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE p.facility_mflcode  = ";

		$sql.=	$facility;

        $sql.=  " AND p.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.mflcode= ";                

        $sql.=	$facility;

 		$sql.=  " AND p_e.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}





	//function to filter events by county and start date

	public function filter_events_by_county_and_start_date($county,$start_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   						p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				 FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE fac.county  = '";

		$sql.=	$county;

        $sql.=  "' AND p.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.county= '";                

        $sql.=	$county;

 		$sql.=  "' AND p_e.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}





	//filter events by facility, start date and end date filter_events_by_facility_and_start_date_and_end_date



	public function filter_events_by_facility_and_start_date_and_end_date($facility,$start_date, $end_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   				p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE p.facility_mflcode  = ";

		$sql.=	$facility;

        $sql.=  " AND p.eventdatetime >= '";

        $sql.=	$start_date;

         $sql.=  "' AND p.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.mflcode= ";                

        $sql.=	$facility;

 		$sql.=  " AND p_e.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.=  "' AND p_e.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}



	//filter events by facility, conty, start date and end date filter_events_by_facility_and_start_date_and_end_date



	public function filter_events_by_facility_and_county_and_start_date_and_end_date($facility, $county,$start_date, $end_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   				p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode ";



				if($county!="" && $start_date == "" && $end_date =="" && $facility=="") {

					$sql.="	WHERE f.county= '";

			        $sql.=$county;

			        $sql.="'";

		   		 }

				else if($county!="" && $start_date != "" && $end_date =="" && $facility=="") {

					$sql.=  " WHERE f.county= '";                

			        $sql.=	$county;

			 		$sql.=  "' AND p.eventdatetime >= '";

			        $sql.=	$start_date;

			        $sql.="'";

				}

				else if($county!="" && $start_date != "" && $end_date !="" && $facility=="") {

					$sql.=  " WHERE f.county= '";                

			        $sql.=	$county;

			 		$sql.=  "' AND p.eventdatetime >= '";

			        $sql.=	$start_date;

			        $sql.=  "' AND p.eventdatetime <= '";

			        $sql.=	$end_date;

			        $sql.="'";

				}

				else if($county!="" && $start_date != "" && $end_date !="" && $facility!="") {

					$sql.=  " WHERE f.mflcode= ";                

			        $sql.=	$facility;

			 		$sql.=  " AND p.eventdatetime >= '";

			        $sql.=	$start_date;

			        $sql.="'";



				}

				else if($county=="" && $start_date != "" && $end_date =="" && $facility=="") {

					$sql.=  " WHERE p.eventdatetime>= '";

					$sql.=	$start_date;

					$sql.="'";

				}

				else if($county=="" && $start_date != "" && $end_date !="" && $facility=="") {

					$sql.=  " WHERE p.eventdatetime>= '";

					$sql.=$start_date;

					$sql.="' AND p.eventdatetime<= '";

					$sql.=$end_date;

					$sql.="'";

				}

				else if($county=="" && $start_date != "" && $end_date !="" && $facility!="") {

					$sql.=  "  WHERE f.mflcode= ";                

			        $sql.=	$facility;

			 		$sql.=  " AND p.eventdatetime >= '";

			        $sql.=	$start_date;

			        $sql.=  "' AND p.eventdatetime <= '";

			        $sql.=	$end_date;

			        $sql.="'";

				}

				else if($county!="" && $start_date == "" && $end_date !="" && $facility=="") {

					$sql.=  " WHERE f.county= '";                

		        	$sql.=	$county;

		 			$sql.=  "' AND p.eventdatetime <= '";

		       		$sql.=	$end_date;

		       		$sql.="'";

				}

				else if($county!="" && $start_date == "" && $end_date =="" && $facility!="") {

					 $sql.="	WHERE f.mflcode= ";

		        	 $sql.=$facility;

				}

				else if($county!="" && $start_date == "" && $end_date !="" && $facility!="") {

					$sql.=  " WHERE f.mflcode= ";                

			        $sql.=	$facility;

			 		$sql.=  " AND p.eventdatetime <= '";

			        $sql.=	$end_date;

			        $sql.="'";

				}

				else if($county=="" && $start_date == "" && $end_date !="" && $facility=="") {

					$sql.=  " WHERE p.eventdatetime<= '";

					$sql.=$end_date;

					$sql.="'";

				}

				else if($county!="" && $start_date != "" && $end_date =="" && $facility!="") {

					$sql.=  " WHERE f.mflcode= ";                

			        $sql.=	$facility;

			 		$sql.=  " AND p.eventdatetime >= '";

			        $sql.=	$start_date;

			        $sql.="'";

				}



				else if($county=="" && $start_date == "" && $end_date =="" && $facility!="") {

					 $sql.="	WHERE f.mflcode= ";

		        	 $sql.=$facility;

				}

		

        $sql.=	"  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode ";

    //     if($facility != null && $county != "" && $start_date !="" && $end_date != "") {

    //     	$sql.= "WHERE f.mflcode= ";                

    //    		$sql.=	$facility;

	 		// $sql.=  " AND p_e.eventdatetime >= '";

	   //      $sql.=	$start_date;

	   //      $sql.=  "' AND p_e.eventdatetime <= '";

	   //      $sql.=	$end_date;

    //     }

        if($county!="" && $start_date == "" && $end_date =="" && $facility=="") {

				$sql.="	WHERE f.county= '";

		        $sql.=$county;

		        $sql.="'";



		}

		else if($county!="" && $start_date != "" && $end_date =="" && $facility=="") {

			$sql.=  " WHERE f.county= '";                

	        $sql.=	$county;

	 		$sql.=  "' AND p_e.eventdatetime >= '";

	        $sql.=	$start_date;

	        $sql.="'";

		}

		else if($county!="" && $start_date != "" && $end_date !="" && $facility=="") {

			$sql.=  " WHERE f.county= '";                

	        $sql.=	$county;

	 		$sql.=  "' AND p_e.eventdatetime >= '";

	        $sql.=	$start_date;

	        $sql.=  "' AND p_e.eventdatetime <= '";

	        $sql.=	$end_date;

	        $sql.="'";

		}

		else if($county!="" && $start_date != "" && $end_date !="" && $facility!="") {

			$sql.=  " WHERE f.mflcode= ";                

	        $sql.=	$facility;

	 		$sql.=  " AND p_e.eventdatetime >= '";

	        $sql.=	$start_date;

	        $sql.="'";



		}

		else if($county=="" && $start_date != "" && $end_date =="" && $facility=="") {

			$sql.=  " WHERE p_e.eventdatetime>= '";

			$sql.=	$start_date;

			$sql.="'";

		}

		else if($county=="" && $start_date != "" && $end_date !="" && $facility=="") {

			$sql.=  " WHERE p_e.eventdatetime>= '";

			$sql.=$start_date;

			$sql.="' AND p_e.eventdatetime<= '";

			$sql.=$end_date;

			$sql.="'";

		}

		else if($county=="" && $start_date != "" && $end_date !="" && $facility!="") {

			$sql.=  "  WHERE f.mflcode= ";                

	        $sql.=	$facility;

	 		$sql.=  " AND p_e.eventdatetime >= '";

	        $sql.=	$start_date;

	        $sql.=  "' AND p_e.eventdatetime <= '";

	        $sql.=	$end_date;

	        $sql.="'";

		}

		else if($county!="" && $start_date == "" && $end_date !="" && $facility=="") {

			$sql.=  " WHERE f.county= '";                

        	$sql.=	$county;

 			$sql.=  "' AND p_e.eventdatetime <= '";

       		$sql.=	$end_date;

       		$sql.="'";

		}

		else if($county!="" && $start_date == "" && $end_date =="" && $facility!="") {

			 $sql.="	WHERE f.mflcode= ";

        	 $sql.=$facility;

		}

		else if($county!="" && $start_date == "" && $end_date !="" && $facility!="") {

			$sql.=  " WHERE f.mflcode= ";                

	        $sql.=	$facility;

	 		$sql.=  " AND p_e.eventdatetime <= '";

	        $sql.=	$end_date;

	        $sql.="'";

		}

		else if($county=="" && $start_date == "" && $end_date !="" && $facility=="") {

			$sql.=  " WHERE p_e.eventdatetime<= '";

			$sql.=$end_date;

			$sql.="'";

		}

		else if($county!="" && $start_date != "" && $end_date =="" && $facility!="") {

			$sql.=  " WHERE f.mflcode= ";                

	        $sql.=	$facility;

	 		$sql.=  " AND p_e.eventdatetime >= '";

	        $sql.=	$start_date;

	        $sql.="'";

		}

		else if($county=="" && $start_date == "" && $end_date =="" && $facility!="") {

					 $sql.="	WHERE f.mflcode= ";

		        	 $sql.=$facility;

				}

                

        $sql.=" GROUP BY p_e.event_id";

        //echo( $sql);

        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}

		

	}



	//filter events by county, start date and end date filter_events_by_facility_and_start_date_and_end_date



	public function filter_events_by_county_and_start_date_and_end_date($county,$start_date, $end_date){

		$sql=	"SELECT CASE WHEN  p_e.event_id=8 THEN

								(SELECT COUNT(C.person_id) FROM (select count(person_id), person_id, min(eventdatetime) 

						        FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C )

							WHEN p_e.event_id=21 THEN

						        (SELECT COUNT(person_id) FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) 

								FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C)

							WHEN p_e.event_id = 6 THEN 

						        (SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C)

					        WHEN p_e.event_id=7 THEN

								(SELECT COUNT(C.person_id) FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime)

								FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C)	

	        				ELSE COUNT( p_e.event_id )

			    		END AS event_count,

   				p_e.event_id,e.verbose_name, e.name AS event_name, e.description, ((SELECT COUNT( p.event_id ) AS total_event_count

				FROM personevents p JOIN facility fac ON fac.mflcode = p.facility_mflcode WHERE fac.county  = '";

		$sql.=	$county;

        $sql.=  "' AND p.eventdatetime >= '";

        $sql.=	$start_date;

         $sql.=  "' AND p.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.=	"'  )) AS total_event_count, f.facilityname AS facility_name, f.mflcode AS facility_mflcode, f.county AS facility_county	

                FROM personevents p_e  

                JOIN EVENTS e ON e.idevent = p_e.event_id

                JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.county= '";                

        $sql.=	$county;

 		$sql.=  "' AND p_e.eventdatetime >= '";

        $sql.=	$start_date;

        $sql.=  "' AND p_e.eventdatetime <= '";

        $sql.=	$end_date;

        $sql.="' GROUP BY p_e.event_id";



        $query=$this->db->query($sql);

		if($query->num_rows()>0)

		{

			foreach ($query->result() as $row) 

			{

				# code...

				$rows[]=$row;

			}

			return $rows;

		}

		else

		{

			return false;

		}



	}



	// get total event counts

	public function get_total_event_counts()

	{



		$sql='SELECT SUM(TOTALS) AS total_event_count FROM (SELECT COUNT(C.person_id) as totals FROM (select count(person_id), person_id, min(eventdatetime) FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=8 and value_numeric=3 or value_numeric=4) E GROUP BY E.PERSON_ID) C 

				UNION

				SELECT COUNT(person_id) as total_event_count FROM ( SELECT COUNT(person_id), person_id, MIN(eventdatetime) FROM( SELECT DISTINCT person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource FROM personevents WHERE event_id=21) E GROUP BY person_id) C

				UNION

				SELECT COUNT(C.person_id)  as total_event_count FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime) FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=6) E GROUP BY E.PERSON_ID) C

				UNION 

				SELECT COUNT(C.person_id)  as total_event_count FROM (SELECT COUNT(person_id), person_id, MIN(eventdatetime) FROM( select distinct person_id, eventdatetime, value_boolean, value_coded, value_datetime, value_numeric, value_text, valuesource from personevents where event_id=7) E GROUP BY E.PERSON_ID) C	

				UNION

				SELECT COUNT( p_e.event_id )  as total_event_count FROM personevents p_e WHERE p_e.event_id NOT IN(8,7, 21, 6)

				) D';



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}

	

	//get total event count by facility

	public function get_total_event_counts_by_facility($facility)

	{



		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

                WHERE p_e.facility_mflcode = ";

		$sql.=$facility;



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total event count by county

	public function get_total_event_counts_by_county($county)

	{



		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

				JOIN facility f ON f.mflcode=p_e.facility_mflcode

                WHERE f.county = '";

		$sql.=$county;

		$sql.="'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1) {

			return $query->row();

		}

		else {

			return false;

		}



	}



	//get total event counts by facility and end date

	public function get_total_event_counts_by_facility_and_end_date($facility,$end_date){

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

                WHERE p_e.facility_mflcode = ";

		$sql.=$facility;

		$sql.=" AND p_e.eventdatetime <='";

		$sql.=$end_date;

		$sql.="'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total event counts by county and end date

	public function get_total_event_counts_by_county_and_end_date($county,$end_date){

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

				JOIN facility f ON f.mflcode = p_e.facility_mflcode 

                WHERE f.county = '";

		$sql.=	$county;

		$sql.=	"' ";

		$sql.=	" AND p_e.eventdatetime <= '";

		$sql.=	$end_date;

		$sql.=	"'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total event counts by facility and start date

	public function get_total_event_counts_by_facility_and_start_date($facility,$start_date){

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

                WHERE p_e.facility_mflcode = ";

		$sql.=$facility;

		$sql.=" AND p_e.eventdatetime >='";

		$sql.=$start_date;

		$sql.="'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total event counts by county and start date

	public function get_total_event_counts_by_county_and_start_date($county,$start_date) {

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

				JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.county = '";

        $sql.=	$county;

        $sql.=	"'AND p_e.eventdatetime >='";

        $sql.=	$start_date;

        $sql.=	"'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total event counts by facility and start date and end date

	public function get_total_event_counts_by_facility_and_start_date_and_end_date($facility,$start_date, $end_date){

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

                WHERE p_e.facility_mflcode = ";

		$sql.=$facility;

		$sql.=" AND p_e.eventdatetime >='";

		$sql.=$start_date;

		$sql.="' AND p_e.eventdatetime <='";

		$sql.=$end_date;

		$sql.="'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total event counts by county and start date and end date

	public function get_total_event_counts_by_county_and_start_date_and_end_date($county,$start_date, $end_date){

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e

				JOIN facility f ON f.mflcode = p_e.facility_mflcode

                WHERE f.county = '";

		$sql.=$county;

		$sql.="' AND p_e.eventdatetime >='";

		$sql.=$start_date;

		$sql.="' AND p_e.eventdatetime <='";

		$sql.=$end_date;

		$sql.="'";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}





	//get total event count by start date

	public function get_total_event_counts_by_start_date($start_date)

	{

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e WHERE p_e.eventdatetime >= '";

		$sql.=$start_date;

		$sql.="'";

		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total event count by end date

	public function get_total_event_counts_by_end_date($end_date)

	{

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e WHERE p_e.eventdatetime <= '";

		$sql.=$end_date;

		$sql.="'";

		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total event count by start date and end date

	public function get_total_event_counts_by_start_date_and_end_date($start_date,$end_date)

	{

		$sql="	SELECT COUNT( p_e.event_id ) AS total_event_count

				FROM personevents p_e WHERE p_e.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="' AND p_e.eventdatetime<= '";

		$sql.=$end_date;

		$sql.="'";

		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	

	//get total person count by start date

	public function get_total_person_counts_by_start_date($start_date)

	{

		$sql="SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="'	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total patient count by end date

	public function get_total_person_counts_by_end_date($end_date)

	{

		$sql="SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.eventdatetime>= '";

		$sql.=$end_date;

		$sql.="'	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total person count by start date and end date

	public function get_total_person_counts_by_start_date_and_end_date($start_date, $end_date)

	{



		$sql="SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.eventdatetime>= '";

		$sql.=$start_date;

		$sql.="' AND p_e.eventdatetime<= '";

		$sql.=$end_date;

		$sql.="'	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}

	

	//get total person count by facility

	public function get_total_person_counts_by_facility($facility)

	{



		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.facility_mflcode = ";

		$sql.=$facility;

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total person count by county

	public function get_total_person_counts_by_county($county)

	{



		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e 

				JOIN facility f ON f.mflcode=p_e.facility_mflcode

				WHERE f.county = '";

		$sql.=$county;

		$sql.="'	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total person count by facility and end date 

	public function get_total_person_counts_by_facility_and_end_date($facility, $end_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.facility_mflcode = ";

		$sql.=	$facility;

		$sql.= 	" AND p_e.eventdatetime<= '";

		$sql.=	$end_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total person count by facility and start date 

	public function get_total_person_counts_by_facility_and_start_date($facility, $start_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.facility_mflcode = ";

		$sql.=	$facility;

		$sql.= 	" AND p_e.eventdatetime>= '";

		$sql.=	$start_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total person count by county and start date 

	public function get_total_person_counts_by_county_and_start_date($county, $start_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e JOIN facility f ON f.mflcode=p_e.facility_mflcode

				WHERE f.county = '";

		$sql.=	$county;

		$sql.= 	"' AND p_e.eventdatetime>= '";

		$sql.=	$start_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}





	//get total person count by county and start date 

	public function get_total_person_counts_by_county_and_end_date($county, $end_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e 

				JOIN facility f ON f.mflcode=p_e.facility_mflcode 

				WHERE f.county = '";

		$sql.=	$county;

		$sql.= 	"' ";

		$sql.=	"AND p_e.eventdatetime<= '";

		$sql.=	$end_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get total person count by facility and start date and end date

	public function get_total_person_counts_by_facility_and_start_date_and_end_date($facility, $start_date, $end_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e WHERE p_e.facility_mflcode = ";

		$sql.=	$facility;

		$sql.= 	" AND p_e.eventdatetime>= '";

		$sql.=	$start_date;

		$sql.=	"' ";

		$sql.= 	" AND p_e.eventdatetime<= '";

		$sql.=	$end_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}

	// get total number of patiensts

	public function get_total_person_counts()

	{



		$sql='	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e 

				) a';



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}



	}



	//get total person count by county and start date and end date

	public function get_total_person_counts_by_county_and_start_date_and_end_date($county, $start_date, $end_date){

		$sql="	SELECT COUNT( a.person_id ) AS total_person_count

				FROM (	



				SELECT DISTINCT p_e.person_id

				FROM personevents p_e 

				JOIN facility f ON f.mflcode=p_e.facility_mflcode

				WHERE f.county = '"; 

		$sql.=	$county;

		$sql.= 	"' AND p_e.eventdatetime>= '";

		$sql.=	$start_date;

		$sql.=	"' ";

		$sql.= 	" AND p_e.eventdatetime<= '";

		$sql.=	$end_date;

		$sql.=	"' ";

		$sql.="	) a";



		$query=$this->db->query($sql);



		if($query->num_rows()==1)

		{

			return $query->row();

		}

		else

		{

			return false;

		}

	}



	//get gender based monthly event distribution by event and county

	public function get_gender_based_monthly_event_distribution_by_event_id_and_county($event_id,$county)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county



						) AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by county

	public function get_gender_based_monthly_event_distribution_by_county($county)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND f.county = A.county



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND f.county = A.county



						) AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}







	//get gender based monthly event distribution by event id and facility

	public function get_gender_based_monthly_event_distribution_by_event_id_and_facility($event_id, $facility)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode



						) AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.mflcode = '";

				$sql.=$facility;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by facility

	public function get_gender_based_monthly_event_distribution_by_facility($facility)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode



						) AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.mflcode = '";

				$sql.=$facility;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	

	//get gender based monthly event distribution by event_id and county and start date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_county_and_start_date($event_id,$county,$start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by county and start date

	public function get_gender_based_monthly_event_distribution_by_county_and_start_date($county,$start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE  fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





//get gender based monthly event distribution by event id and county and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_county_and_end_date($event_id, $county, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by county and end date

	public function get_gender_based_monthly_event_distribution_by_county_and_end_date($county, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





//get gender based monthly event distribution by event id and facility and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_facility_and_end_date($event_id, $facility, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.mflcode = '";

				$sql.=$facility;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ORDER BY p_e.eventdatetime";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY MONTH, YEAR ORDER BY YEAR, MONTH ";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by facility and end date

	public function get_gender_based_monthly_event_distribution_by_facility_and_end_date( $facility, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.mflcode = '";

				$sql.=$facility;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ORDER BY p_e.eventdatetime";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY MONTH, YEAR ORDER BY YEAR, MONTH ";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





	//get gender based monthly event distribution by event id and county and start date and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_county_and_start_date_and_end_date($event_id, $county, $start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id =";

				$sql.=$event_id;

				$sql.=" AND fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ORDER BY p_e.eventdatetime ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





	//get gender based monthly event distribution by county and start date and end date

	public function get_gender_based_monthly_event_distribution_by_county_and_start_date_and_end_date($county, $start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.county = A.county

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.county = '";

				$sql.=$county;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ORDER BY p_e.eventdatetime ";

				$sql.=" ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





//get gender based monthly event distribution by event id and facility and start date and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_facility_and_start_date_and_end_date($event_id, $facility, $start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id = ";

				$sql.=$event_id;

				$sql.=" AND fac.mflcode = ";

				$sql.=$facility;

				$sql.=" ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by facility and start date and end date

	public function get_gender_based_monthly_event_distribution_by_facility_and_start_date_and_end_date($facility, $start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE  fac.mflcode = ";

				$sql.=$facility;

				$sql.=" ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}







//get gender based monthly event distribution by facility and start date 

	public function get_gender_based_monthly_event_distribution_by_event_id_and_facility_and_start_date($event_id, $facility, $start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id = ";

				$sql.=$event_id;

				$sql.=" AND fac.mflcode = ";

				$sql.=$facility;

				$sql.=" ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";				

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by facility and start date 

	public function get_gender_based_monthly_event_distribution_by_facility_and_start_date($facility, $start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND f.mflcode = A.mflcode

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE fac.mflcode = ";

				$sql.=$facility;

				$sql.=" ";

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";				

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





//get gender based monthly event distribution by event id and start date and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_start_date_and_end_date($event_id, $start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id = ";

				$sql.=$event_id;

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by event id and start date and end date

	public function get_gender_based_monthly_event_distribution_by_start_date_and_end_date($start_date, $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' AND pe.eventdatetime <= '";

				$sql.=$end_date;

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.eventdatetime >= '";

				$sql.=$start_date;

				$sql.="' ";

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;

				$sql.="' ";

				$sql.=" ORDER BY p_e.eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR, MONTH";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



//get gender based monthly event distribution by event id andstart date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_start_date($event_id,  $start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH, EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR  , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id = ";

				$sql.=$event_id;

				$sql.=" AND p_e.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.="' ORDER BY p_e.eventdatetime) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by start date

	public function get_gender_based_monthly_event_distribution_by_start_date($start_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH, EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR  , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE  p_e.eventdatetime >= '";

				$sql.=$start_date;				

				$sql.="' ORDER BY p_e.eventdatetime) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





	//get gender based monthly event distribution by event id and end date

	public function get_gender_based_monthly_event_distribution_by_event_id_and_end_date($event_id,  $end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE p_e.event_id = ";

				$sql.=$event_id;

				$sql.=" AND p_e.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.="' ORDER BY p_e.eventdatetime) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get gender based monthly event distribution by end date

	public function get_gender_based_monthly_event_distribution_by_end_date($end_date)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.=" ') AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							JOIN facility f ON f.mflcode = pe.facility_mflcode

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id

							AND pe.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.=" ') AS FEMALE_COUNT

						FROM (



						SELECT p_e.eventdatetime, p_e.event_id, fac.county, fac.facilityname, fac.mflcode

						FROM personevents p_e

						JOIN facility fac ON fac.mflcode = p_e.facility_mflcode

						WHERE  p_e.eventdatetime <= '";

				$sql.=$end_date;				

				$sql.="' ORDER BY p_e.eventdatetime) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}









//get specific event count grouped by month and gender and event_id

	public function get_event_count_by_month_and_event_id($event_id)

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id)

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id



						) AS FEMALE_COUNT

						FROM (

						SELECT eventdatetime, event_id

						FROM personevents

						WHERE event_id =";

				$sql.=$event_id;

				$sql.=" ORDER BY eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR ";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}





	//get specific event count grouped by month and gender and event_id

	public function get_event_count_by_month()

	{

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count, verbose_name,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						event_id,



						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id



						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id)

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

							AND pe.event_id =A.event_id



						) AS FEMALE_COUNT

						FROM (

						SELECT eventdatetime, event_id

						FROM personevents ";

				$sql.=" ORDER BY eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR ";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get specific event count grouped by month and gender



	public function get_gender_based_monthly_event_distribution() {

		try {

				$sql="	SELECT EXTRACT(

						MONTH FROM eventdatetime ) AS

						MONTH , EXTRACT(

						YEAR FROM eventdatetime ) AS

						YEAR , count( event_id ) AS event_count,

						CASE EXTRACT(MONTH FROM eventdatetime )

						WHEN 1

						THEN 'January'

						WHEN 2

						THEN 'February'

						WHEN 3

						THEN 'March'

						WHEN 4

						THEN 'April'

						WHEN 5

						THEN 'May'

						WHEN 6

						THEN 'June'

						WHEN 7

						THEN 'July'

						WHEN 8

						THEN 'August'

						WHEN 9

						THEN 'September'

						WHEN 10

						THEN 'October'

						WHEN 11

						THEN 'November'

						WHEN 12

						THEN 'December'

						ELSE 'xxxxx'

						END AS MONTH_NAME,

						(

							SELECT COUNT( pe.event_id )

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'MALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )

						) AS MALE_COUNT,

						

						(

							SELECT COUNT( pe.event_id)

							FROM personevents pe

							JOIN person p ON p.person_id = pe.person_id

							WHERE p.Sex = 'FEMALE'

							AND EXTRACT(

							MONTH FROM pe.eventdatetime ) = EXTRACT( MONTH FROM A.eventdatetime )



						) AS FEMALE_COUNT

						FROM (

						SELECT eventdatetime, event_id

						FROM personevents ";

				$sql.=" ORDER BY eventdatetime ) A JOIN EVENTS e ON e.idevent = A.event_id GROUP BY YEAR, MONTH ORDER BY YEAR ";

				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

					{

						# code...

						$rows[]=$row;

					}

					return $rows;

				}

				else

				{

					return false;

				}

	

		} catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}









	//get all counties

	public function get_counties()

	{

		try {



				$sql='	SELECT DISTINCT county

						FROM facility

						ORDER BY county';



				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

							{

								# code...

								$rows[]=$row;

							}

							return $rows;

						}

				else

				{

					return false;

				}

		}

		catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get all facilities

	public function get_facilities()

	{

		try {



				$sql='	SELECT DISTINCT mflcode, facilityname

						FROM facility

						ORDER BY facilityname';



				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

							{

								# code...

								$rows[]=$row;

							}

							return $rows;

						}

				else

				{

					return false;

				}

		}

		catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get all facilities by county

	public function get_facilities_by_county($county_name)

	{

		try {



				$sql='	SELECT DISTINCT mflcode, facilityname

						FROM facility

						WHERE county = ';

				$sql.= '"'.$county_name.'"';

				$sql.='	ORDER BY facilityname ';



				$query=$this->db->query($sql);



				if($query->num_rows()>0)

				{

					foreach ($query->result() as $row) 

							{

								# code...

								$rows[]=$row;

							}

							return $rows;

						}

				else

				{

					return false;

				}

		}

		catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}



	//get county by facility code

	public function get_county_by_facility_code($mflcode)

	{

		try {



				$sql='	SELECT DISTINCT county

						FROM facility

						WHERE mflcode = ';

				$sql.= $mflcode;



				$query=$this->db->query($sql);



				if($query->num_rows()==1)

				{

					return $query->row();

				}

				else

				{

					return false;

				}

		}

		catch (Exception $e) {

			echo "Error Message".$e->getMessage();

		}

	}

}
