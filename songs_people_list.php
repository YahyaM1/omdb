<?php

  $nav_selected = "SONGS";
  $left_buttons = "YES"; 
  $left_selected = "PEOPLE";

  include("./nav.php");
  global $db;

  ?>


<div class="right-content">
    <div class="container">

      <h3 style = "color: #01B0F1;">Songs -> Songs List with People</h3>

        <h3><img src="images/movies.png" style="max-height: 35px;" />Songs List with People</h3>

        <table id="info" cellpadding="0" cellspacing="0" border="0"
            class="datatable table table-striped table-bordered datatable-style table-hover"
            width="100%" style="width: 100px;">
              <thead>
                <tr id="table-first-row">
                        <th>Song ID</th>
                        <th>Title</th>
                        <th>role</th>
                        <th>People ID</th>
                        <th>Artitst</th>
                       


                </tr>
              </thead>

              <tbody>

              <?php

$sql = "SELECT songs.`song_id`, `title`, `role`, `screen_name`, `people_id` AS `id` FROM `songs` INNER JOIN `song_people` ON `song_people`.`song_id`= `songs`.`song_id`INNER JOIN `people` ON `people`.`id`= `song_people`.`people_id`";

// TODO: The above SQL statement becomes a  JOIN between movies and movie_data
// If there is no corresponding movie_data, then show those as blanks
//NOTE: Whenever you see ., that means + in PHP

$result = $db->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    // Add four more rows of data which you are getting from the database
                    while($row = $result->fetch_assoc()) {
                        echo '<tr>
                                <td>'.$row["song_id"].'</td>
                                <td>'.$row["title"].'</td>
                                <td>'.$row["role"].'</td>
                                <td>'.$row["id"].'</td>
                                <td>'.$row["screen_name"].'</td>
                            </tr>';
                    }//end while
                }//end if
                else {
                    echo "0 results";
                }//end else

                 $result->close();
                ?>

              </tbody>
        </table>


        <script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#info').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#info thead tr').clone(true).appendTo( '#info thead' );
        $('#info thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#info').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>

        

 <style>
   tfoot {
     display: table-header-group;
   }
 </style>

  <?php include("./footer.php"); ?>
