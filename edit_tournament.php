<? include("conf/config.php");
includeHeader("Edit Tournament");
if(!isset($_GET['id']) && !isset($_POST['id'])) {
        echo "Error: No tournament ID supplied";
} 
else 
{

	$t_id = (isset($_GET['id']))?$_GET['id']:$_POST['id'];
	if(isset($_POST['submit'])){
			$db->update("Tournament", "Name='$_POST[tournament_name]', Rules = '$_POST[rules]', MaxPlayer = $_POST[max_player] , Description='$_POST[description]'","TournamentID=$t_id");
			
	}?>
	<div class="container">
		<div class="row-fluid">
			<div class="span6">
			<?
			$result = $db->select("Tournament", "Name, Description, Rules, MaxPlayer",
					"TournamentID = $t_id")[0]; // get name, description, and rules
			echo "<h1>" . $result['Name'] . "</h1>"; // name
			echo "<p>" . $result['Description'] . "</p>"; // description
			echo "<h3>Rules:</h3><p>" . $result['Rules'] . "</p>";
	
			$participants =$tournament->getParticipants($t_id);
			// print_r($participants);
			if(count($participants)>0){
					echo "<h3>Current Participants:</h3><table>";
					$counter = 0;
					foreach($participants as $val){
						echo "<tr><td>". ($counter+=1) .". </td><td>".$val['Name']."</td><td><i class='icon-remove' onclick='removeParticipant(".$val['ParticipantID'].")'></i></td></tr>";
					}  
					echo "</table>";				
			}
			else{
					echo "<h3>No Participants</h3>";
			}
	
			
		echo "</div><div class='span6'>";
	}
	?>
	
      <?if($result['MaxPlayer'] !== "" && $result['MaxPlayer'] > count($participants)){?>
	<form action="register.php" method="POST">
	  <fieldset>
	    <h2 class="form-signin-heading">Add Player</h2>
	        <input type="hidden" name="id" value="<? echo $t_id; ?>"/>
	        <input name="name" type="text" placeholder="Participant Name"/><br>
	        <input class="btn btn-primary btn-large" type="submit" name="submit" value="Add Player" />
	  </fieldset>
	</form><?}else{
		echo "<p>Tournament is FULL!</p>";
	}?>
	</div>
	<div class='span6'>
	<form action="edit_tournament.php" method="POST">
	  <fieldset>
	    <h2 class="form-signin-heading"><? echo $result['Name']; ?></h2>
	        <input type="hidden" name="id" value="<? echo $t_id; ?>"/>
	        <input name="tournament_name" type="text" placeholder="<? echo $result['Name']; ?>"/>
	        <select name="type">
	          <option value="SINGLE">Single Elimination</option>
	          <option value="DOUBLE">Double Elimination</option>
	          <option value="ELO">Elo Ranking System</option>
	          <option value="MTG">Tournament Inspired by MtG</option>
	        </select><br>
	        <input name="max_player" type="number" value="<?=$result['MaxPlayer']?>" placeholder="max number of player"/><br>
	        <textarea class="input-block-level" name="description" rows="3" value="<?=$result['Description']?>" placeholder="<? echo $result['Description'] ?>"></textarea><br>
	        <textarea class="input-block-level" name="rules" rows="3" value="<?=$result['Rules']?>" placeholder="<? echo $result['Rules'] ?>"></textarea><br>
	        <input class="btn btn-primary btn-large" type="submit" name="submit" value="Edit Tournament Details" />
	  </fieldset>
	</form>
	
	
	
	
	</div>
     </div>
   </div>
<?require_once("inc/footer.php")?>
