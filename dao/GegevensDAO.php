$sql = "SELECT wp_kinderen.ID, wp_kinderen.achternaam, wp_kinderen.voornaam, wp_kinderen.geslacht, geboortedatum, alleen_naar_huis, medische, tel1, tel2, wp_ouders.familienaam AS oudernaam , wp_ouders.voornaam as oudervoornaam, email, adres, postcode, stad, notities, wp_kinderen.registratiedatum, wp_kinderen.updatedatum, GROUP_CONCAT(wp_aanwezig.dagtype) as dagtypes, GROUP_CONCAT(wp_aanwezig.dag) as dagen, GROUP_CONCAT(wp_aanwezig.week) as weken, GROUP_CONCAT(wp_aanwezig.jaar) as jaar 
			FROM wp_kinderen 
			LEFT JOIN wp_ouders ON wp_kinderen.user_id = wp_ouders.user_id 
			LEFT JOIN wp_aanwezig ON wp_aanwezig.kind_id = wp_kinderen.ID 
			WHERE wp_aanwezig.jaar = :jaar 
			GROUP BY wp_kinderen.ID ";