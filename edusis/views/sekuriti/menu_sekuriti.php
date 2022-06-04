	<?php $this->load->view('tray');?>

	<hr class="noscreen" />
        <ul id="nav">
            <?php
                for($i=1;$i<=count($menu);$i++)
                {
                    $kelas  = '';
                    if($pilihmenu == $menu[$i]['nama'])
                    {
                        $kelas  = 'class="current"';
                    }
                    echo '<li '.$kelas.'><a href="'.$menu[$i]['link'].'">'.$menu[$i]['nama'].'</a>';
                    if(count($menu[$i]['nilai'])!=0)
                    {
                        echo '<ul>';
                        for($j=1;$j<=count($menu[$i]['nilai']);$j++)
                        {
                            echo '<li>';
                            echo '<a href="'.$menu[$i]['nilai'][$j]['link'].'">'.$menu[$i]['nilai'][$j]['nama'].'</a></li>';
                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
            ?>
        </ul>
	<hr class="noscreen" />
	<!-- Columns -->
	<div id="cols" class="box">
		<!-- Aside (Left Column) -->
		<div id="aside" class="box">
			<div class="padding box">
				<!-- Logo (Max. width = 200px) -->
				<p id="logo"><a href="<?php echo site_url('home/index')?>"><img src="<?php echo base_url()?>edusis_asset/edusisimg//logo2.png" alt="Our logo" title="Visit Site" /></a></p>
				<!-- Search -->
				<!-- Create a new project 
				<p id="btn-create" class="box"><a href="#"><span>Create a new project</span></a></p>-->
			</div> <!-- /padding -->

			<ul class="box">
				<li id="submenu-active"><a href="javascript:toggle('org');">Menu Sekuriti</a>
					<ul id="org">
						<li><a href="<?php echo base_url(); ?>index.php/sekuriti/user">User</a>
                        </li>
						<li><a href="<?php echo base_url(); ?>index.php/sekuriti/otorisasi">Group Otorisasi</a>
                        </li>
						<li><a href="<?php echo base_url(); ?>index.php/sekuriti/group">Group User</a>
                        </li>
					</ul>
				</li>
			</ul>			
		</div> <!-- /aside -->

		<hr class="noscreen" />