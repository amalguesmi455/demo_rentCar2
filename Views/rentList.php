


<style>

.head{
    display: flex;
    align-items: center;
    justify-content: space-between;
}


</style>


<div class="head">


<h1 >My rents list</h1>

</div>
                <table class='display' id="tab">
                    <thead>
                        <tr>
                            <th> Marque</th>
                            <th>Modele</th>
                            <th>prix_location</th>
                            <th>date_debut</th>
                            <th>date_fin</th>
                            
                        </tr>
                    </thead>
                    <tbody>



<?php
        // Output data of each row
        foreach ($rentList as $rent) {
            
            echo "<tr>";
            echo "<td>" . $rent["marque"] . "</td>";
            echo "<td>" . $rent["model"] . "</td>";
            echo "<td>" . $rent["hourly_price"] . " $</td>";
            echo "<td>" . $rent["rent_start"] . "</td>";
            echo "<td >" . $rent["rent_end"] . "</td>";
            echo "</tr>";
        }
?>
        
        </tbody>
                </table>

                <script >
        $(document).ready(function() {
            $('#tab').DataTable();
        });

    </script>
    