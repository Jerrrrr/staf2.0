  <!-- page content -->
<section class="right_col" role="main">
         <div>
           <div class="row top_tiles">
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['vm']; ?> </div>
                 <h3>Voormiddag</h3>
                 <p>Aantal kinderen aanwezig voormiddag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-comments-o"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['vd']; ?></div>
                 <h3>Volle dag</h3>
                 <p>Aantal kinderen aanwezig volle dag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-sort-amount-desc"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['nm']; ?></div>
                 <h3>Namiddag</h3>
                 <p>Aantal kinderen aanwezig namiddag</p>
               </div>
             </div>
             <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
               <div class="tile-stats">
                 <div class="icon"><i class="fa fa-check-square-o"></i></div>
                 <div class="count"><?php echo $data['present_vandaag']['tot']; ?></div>
                 <h3>Totaal</h3>
                 <p>Aantal kinderen vandaag aanwezig</p>
               </div>
             </div>
           </div>

          </div>
          <div class="row tile_count">
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
               <span class="count_top"><i class="fa fa-clock-o"></i> Nieuw vandaag</span>
               <div class="count "><?php echo $data['register_vandaag']; ?></div>
             </div>
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
               <span class="count_top"><i class="fa fa-user"></i> Nieuw Gisteren</span>
               <div class="count "><?php echo $data['register_yesterday']; ?></div>
             </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Totaal kinderen / waarvan actief</span>
                <div class="count green"><?php echo $data['kinderen_totaal'] .' / '. $data['kinderen_totaal_active']; ?></div>
                <!-- <span class="count_bottom"><i class="green">4% </i> From last Week</span> -->
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Totaal Gisteren</span>
                  <div class="count green"><?php echo $data['present_yesterday']['tot']; ?></div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Gisteren Volle dag</span>
                <div class="count"><?php echo $data['present_yesterday']['vd']; ?></div>
              </div>
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Gisteren Halve dag</span>
                <div class="count"><?php echo $data['present_yesterday']['vm'] + $data['present_yesterday']['nm'] ; ?></div>
              </div>


            </div>

           <div class="row">
             <div class="col-md-12">
               <div class="x_panel">
                 <div class="x_title">
                   <h2>Transaction Summary <small>Weekly progress</small></h2>
                   <ul class="nav navbar-right panel_toolbox">
                     <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                   </ul>
                   <div class="clearfix"></div>
                 </div>
                 <div class="x_content" style="padding: 1rem;">
                   <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="demo-container" style="height:280px">
                       <div id="chart" class="demo-placeholder"></div>
                     </div>

                     <form action="index.php" method="post">
                       <div class="form-group">
                         <label class="control-label col-md-2 col-sm-3 col-xs-12" hidden for="jaar">jaar:</label>
                           <div class="col-md-2 col-sm-3 col-xs-12">
                             <select class="form-control" name="jaar" id="jaar">
                               <?php for ($i = date("Y") ; $i >= 2016; $i--): ?>
                                 <option value="<?php echo $i ?>"
                                   <?php if (isset($_GET["jaar"])): if($_GET["jaar"] == $i): echo "selected"; endif; endif; ?>
                                   <?php if (isset($_POST["jaar"])): if($_POST["jaar"] == $i): echo "selected"; endif; endif; ?>
                                  ><?php echo $i ?></option>
                               <?php endfor; ?>
                             </select>
                           </div>
                       </div>
                       <button type="submit" class="btn btn-round btn-primary">Kies jaar</button>
                     </form>
                   </div>

                 </div>
               </div>
             </div>
           </div>
           

          <div class="row">

            <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Extra opties kinderen</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </ul>
                  <div class="clearfix" ></div>
                </div>
                <div class="x_content">
                  <br />
                  <span class="error" style="color: #BA383C;"><?php if(!empty($errors)) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['reset_check']}</p>";?></span>
                  <p>Voor te zien welke kinderen er ingeschreven zijn voor dit jaar moet er in januari de kinderen op actief op <b>NEEN</b> worden gezet. Dit kan door te checkbox aan te vinken en op de knop te klikken. Dan zijn alle kinderen voor dit jaar actief op <b>NEEN</b> gezet. </p>
                  <form action="index.php" method="post">
                    <div class="form-group">
                      <div class="col-md-12 col-sm-3 col-xs-12">
                        <div style="display: inline;" class="checkbox">
                          <label>
                            <input type="checkbox" name="reset_check" class="flat"> Vink mij aan voor te resetten!
                          </label>
                        </div>
                        <button style="margin-left: 2rem; margin-bottom: 5px;" type="submit" class="btn btn-round btn-danger" name="resetten" >RESET!</button>
                      </div>
                    </div>  
                  </form>
                </div>
              </div>
            </div>


            <div class="col-md-6 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Kinderen verboden op foto's</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </ul>
                  <div class="clearfix" ></div>
                </div>
                <div class="x_content">
                  <br />
                  <span class="error" style="color: #BA383C;"><?php if(!empty($errors)) echo "<p class=\"error\" style=\"color: #BA383C;\">{$errors['reset_check']}</p>";?></span>
                  <p>Hieronder worden alle kinderen gevonden die <b>NIET</b> op een foto mogen staan</p>
                  <ul class="to_do">
                  <?php foreach ( $NoPhotoNames as $key => $value) { ?>
                      <li class="strong-names"  > <?php echo $value['voornaam'].' '. $value['achternaam']  ?></li>    
                  <?php }?>
                  </ul>

                </div>
              </div>
            </div>
            
          </div>      


</section>
<?php
  echo "<script type=\"text/javascript\">\n";
    echo "graficJS = ${grafic};\n";
    echo "graficJS_HD = ${grafic_HD};\n";
    echo "graficJS_VD = ${grafic_VD};\n";
  echo "</script>\n";
?>
<script type="text/javascript" src="vendors/echarts/echarts-all-3.js"></script>
<script type="text/javascript" src="vendors/echarts/ecStat.min.js"></script>
<script type="text/javascript" src="vendors/echarts/extension/dataTool.min.js"></script>
<!-- <script type="text/javascript" src="http://echarts.baidu.com/gallery/vendors/echarts/map/js/china.js"></script> -->
<script type="text/javascript" src="vendors/echarts/map/js/world.js"></script>
<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=ZUONbpqGBsYGXNIYHicvbAbM"></script>
<script type="text/javascript" src="vendors/echarts/extension/bmap.min.js"></script>
<script type="text/javascript" src="js/grafic.js"></script>
