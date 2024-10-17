<div class="spaces-list">
    <a href="create.php"><button class="creategh"><i class="fa-solid fa-plus"></i> Create Space</button></a>
    <?php
        $spacesQ = mysqli_query($conn, "SELECT space_id, members,space_name, them_color, space_description FROM spaces WHERE space_id IN (SELECT space_id FROM space_membership WHERE user_id = '{$_SESSION['user_id']}') ORDER BY date_created DESC LIMIT 12");
        if(mysqli_num_rows($spacesQ) > 0)
        {
            while($space_data = mysqli_fetch_assoc($spacesQ)){
        ?>
            <a href="space.php?space_id=<?php echo $space_data ['space_id']?>">
                <div class="spanc-containenjk" style="background: linear-gradient(160deg, <?php echo $space_data['them_color']?>, transparent)">
                    <div class="spance-name"><?php echo $space_data['space_name']?></div>
                    <div class="space-biojkf"><?php echo $space_data['space_description']?></div>
                    <div class="space-activitu"><?php echo $space_data['members']?> Members</div>
                </div>
            </a>
        <?php
        }}
    ?>
</div>