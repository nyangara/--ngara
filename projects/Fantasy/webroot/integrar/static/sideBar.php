<?php
echo'      

      <div id="sideBar">
        <div id="buscador"> Buscar:
          <input id ="busca" name="Buscar" type="text" lang="es" maxlength="20" />
        </div>
        <div id="twitter">
          <script src="http://widgets.twimg.com/j/2/widget.js"></script>
          <script>
		        new TWTR.Widget({
          			version: 2,
          			type: \'profile\',
              		rpp: 4,
              		interval: 30000,
              		width: 180,
              		height: 230,
              		theme: {
                		shell: {
                      		background: \'#333333\',
                      		color: \'#ffffff\'
                    	},
                	tweets: {
                      	background: \'#6D8103\',
                      	color: \'#ffffff\',
                      	links: \'#e6e3dc\'
                	}
                  	},
                  	features: {
                    scrollbar: false,
                    loop: false,
                    live: false,
                    hashtags: true,
                    timestamp: true,
                    avatars: false,
                    behavior: \'all\'
                    }
	                }).render().setUser(\'lvbp_oficial\').start();
                </script>
        </div>
      </div>

      
    </div>
';
?>