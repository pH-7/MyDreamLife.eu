--
-- Copyright:     (c) 2017, Pierre-Henry Soria. All Rights Reserved.
-- License:       GNU General Public License <https://www.gnu.org/licenses/gpl-3.0.en.html>
--

CREATE TABLE itinerary (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  email varchar(175) NOT NULL,
  residence varchar(175) NOT NULL,
  nationality varchar(175) NOT NULL,
  destination varchar(175) NOT NULL,
  gender varchar(175) NOT NULL,
  age varchar(175) NOT NULL,
  lifestyle varchar(175) NOT NULL,
  background varchar(175) NOT NULL,
  job varchar(175) NOT NULL,
  saving varchar(175) NOT NULL,
  availability varchar(175) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
