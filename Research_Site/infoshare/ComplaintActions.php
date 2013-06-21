<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */




class ComplaintActions {
    
   
 public function search_complaint_list( $status_id=0, $category_id=0, $location_id=0, $period_id=-1, $user_token ) {

        try {            
            
			if( ( $status_id <= 0) && ( $category_id <= 0 ) && ( $location_id <= 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id <= 0 ) && ( $location_id <= 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id <= 0 ) && ( $location_id > 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c.complaint_location = ' . $location_id . ' group by c.complaint_id';
			}
	
			if( ( $status_id <= 0) && ( $category_id <= 0 ) && ( $location_id > 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c.complaint_location = ' . $location_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id > 0 ) && ( $location_id <= 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c_a.complaint_category_id = ' . $category_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id > 0 ) && ( $location_id <= 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c_a.complaint_category_id = ' . $category_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id > 0 ) && ( $location_id > 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c_a.complaint_category_id = ' . $category_id . ' and c.complaint_location = ' . $location_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id <= 0) && ( $category_id > 0 ) && ( $location_id > 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where (c.complaint_status = 1 or c.complaint_status = 2 or c.complaint_status = 4) and c_a.complaint_category_id = ' . $category_id . ' and c.complaint_location = ' . $location_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id <= 0 ) && ( $location_id <= 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c.complaint_status = ' . $status_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id <= 0 ) && ( $location_id <= 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c.complaint_status = ' . $status_id . '   and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id <= 0 ) && ( $location_id > 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c.complaint_status = ' . $status_id . '   and c.complaint_location = ' . $location_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id <= 0 ) && ( $location_id > 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaint_assigned_categories as c_a, complaints as c 
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c.complaint_status = ' . $status_id . '   and c.complaint_location = ' . $location_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id > 0 ) && ( $location_id <= 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c_a.complaint_category_id = ' . $category_id . ' and c.complaint_status = ' . $status_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id > 0 ) && ( $location_id <= 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c_a.complaint_category_id = ' . $category_id . ' and c.complaint_status = ' . $status_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id > 0 ) && ( $location_id > 0) && ( $period_id <= -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c_a.complaint_category_id = ' . $category_id . ' and c.complaint_status = ' . $status_id . ' and c.complaint_location = ' . $location_id . ' group by c.complaint_id';
			}
			
			if( ( $status_id > 0) && ( $category_id > 0 ) && ( $location_id > 0) && ( $period_id > -1) ){
				$search_query = 'select c.complaint_id, c.complaint_reference_number, m.sender, m.date_sent,
                    from_unixtime( m.date_sent, "%H:%i %W %b, %d") as sent_time, m.content, c_a.complaint_category_id 
                    from complaints as c 
                    inner join complaint_assigned_categories as c_a on c.complaint_id = c_a.complaint_id                   
                    inner join complaint_messages as c_m on c.complaint_id = c_m.complaint_id
                    inner join messages as m on c_m.message_id = m.message_id where c_a.complaint_category_id = ' . $category_id . ' and c.complaint_status = ' . $status_id . ' and c.complaint_location = ' . $location_id . ' and c.time_period = ' . $period_id . ' group by c.complaint_id';
			}
       
            print_r($search_query);
            die();
            $result = $db->query( $complaint_list_query, array() );
            $row = $result->fetchAll();
        } catch ( \PDOException $err ) {
            return false;
        }
    }
   
}

$search = new ComplaintActions();
$data = $search->search_complaint_list( 1, 4, 1, 1, "1111" );
print_r($data);
?>
