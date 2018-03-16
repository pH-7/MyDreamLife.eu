--
-- Copyright:     (c) 2017-2018, Pierre-Henry Soria. All Rights Reserved.
-- License:       GNU General Public License <https://www.gnu.org/licenses/gpl-3.0.en.html>
--

CREATE TABLE itinerary (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  email varchar(120) NOT NULL,
  residence varchar(20) NOT NULL,
  nationality varchar(20) NOT NULL,
  destination varchar(20) NOT NULL,
  gender varchar(20) NOT NULL,
  age varchar(20) NOT NULL,
  lifestyle varchar(20) NOT NULL,
  background varchar(20) NOT NULL,
  job varchar(20) NOT NULL,
  saving varchar(20) NOT NULL,
  availability varchar(20) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
