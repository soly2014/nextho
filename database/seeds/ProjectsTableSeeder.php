<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('projects')->delete();
        
        \DB::table('projects')->insert(array (
            0 => 
            array (
                'id' => 8,
                'name' => 'LEILA COMPOUND',
                'district' => 3,
                'delivery_date' => '2016-07-01',
                'available' => 1,
                'description' => 'Leila Compound is a high standard community with total project area of 56500 m 2; 30% residential buildings with unique architectural designs and 70% green surfaces & services

Leila Compound New Cairo is a new residential compound located in New Cairo, In Banafsig Area and near to several important service centers, also New Cairo considered as a central location to Nasr City, Maadi, Heliopolis & Giza.',
                'facilities' => 'Swimming pools 
Health club and Running tracks 
Maintenance System 
Private parking & Electronic Gates 
10000 m2 green areas',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 15:01:39',
                'updated_at' => '2015-10-19 15:01:39',
            ),
            1 => 
            array (
                'id' => 9,
                'name' => 'LA HACIENDA',
                'district' => 10,
                'delivery_date' => '2017-10-01',
                'available' => 1,
                'description' => 'La Hacienda is a unique resort. The developers spared no effort or cost to achieve this uniqueness. Sea view with privacy is the main point that differentiates us from other resorts. ',
                'facilities' => 'Swimming Pools 
Health Club and ladies pool 
COBA Cabana Restaurant 
Gardenia Restaurant 
Children Park
Football Field 
Tennis Courts 
Hotel Reception 
Open Air Cinema 
El Patio Indoor Entertainment 
Roman Theatre 
Mosque Kite Surfing and Water Sport Center',
                'commision_percentag' => 3.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 15:17:07',
                'updated_at' => '2015-10-19 15:17:07',
            ),
            2 => 
            array (
                'id' => 10,
                'name' => 'BELLA VITA',
                'district' => 3,
                'delivery_date' => '2019-10-01',
                'available' => 1,
                'description' => 'The site is located on the bow of the eastern city of New Cairo and bordered by the Northern Limit: Cairo / Suez, and the land of Madint Nasr Company
Southern limit: Barwa project
The eastern limit: Middle Ring Road, and the city of the future
Western limit: a bow-east of the city of New Cairo, and Sheikh Khalifa City and Rehab',
                'facilities' => '"24-hour security - private garages - Health Club - Intercom - private elevator for each building - the possibility of finishing your unit system " smart home "',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 15:24:27',
                'updated_at' => '2015-10-19 15:49:05',
            ),
            3 => 
            array (
                'id' => 11,
                'name' => 'WESTOWN COURTYARD',
                'district' => 7,
                'delivery_date' => '2018-10-01',
                'available' => 1,
                'description' => 'Located in the heart of Westown, The Courtyards is Westown’s newest residential neighborhood offering a variety of living spaces tailored to your needs. The homes are arranged around courtyards, offering green views and private parks for you and your family.',
                'facilities' => 'Secure communal gardens - Views onto communal gardens - Under ground and on-ground parking spaces - Access points for gardening and maintenance - Extremely durable and washable exterior facades - Facades designed to conceal AC units - Premium-grade double-glazed windows - Shops - Boutiques - Cafés And Restaurant',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 19:05:01',
                'updated_at' => '2015-10-19 19:15:12',
            ),
            4 => 
            array (
                'id' => 12,
                'name' => 'EASTOWN',
                'district' => 3,
                'delivery_date' => '2018-10-01',
                'available' => 1,
                'description' => 'Eastown is strategically situated on Road 90, immediately adjacent to the American University in Cairo\'s new campus, a short drive from Cairo International Airport and in the midst of the flourishing communities of New Cairo and Kattameya.',
                'facilities' => 'Secure communal gardens - Views onto communal gardens - Under ground and on-ground parking spaces -Facades designed to conceal AC units - Premium-grade double-glazed windows - Shops - Boutiques - Cafés And Restaurants',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 19:22:34',
                'updated_at' => '2015-10-19 19:22:34',
            ),
            5 => 
            array (
                'id' => 13,
                'name' => 'VILLITTE',
                'district' => 3,
                'delivery_date' => '2018-10-01',
                'available' => 1,
                'description' => 'Villette is in the heart of New Cairo, to the east of downtown Cairo. Strategically located off of Road 90, it is close enough to the hustle and bustle of Eastown and other New Cairo attractions however, far enough from them to give the relaxation and rejuvenation of being in a serene suburb , villette including separate Villas , Twin & town Houses with modern elegant designs  ',
                'facilities' => 'Gym - Tennis courts - Squash courts - Multi-purpose courts - Full size pitch -Swimming - lap pool - junior Olympic - Kids pool with Water Park - Mosque - Spa - Kids play grounds - Organic farm - Church - Central green & central piazza - Area for flea market on weekends - Kiosks in outdoor communal spaces - Pharmacy - Laundry - Supermarket - Bakery - Medical clinic',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2015-10-19 19:36:29',
                'updated_at' => '2015-10-19 19:36:29',
            ),
            6 => 
            array (
                'id' => 14,
                'name' => 'LA NUOVA VISTA',
                'district' => 3,
                'delivery_date' => '2016-01-12',
                'available' => 1,
                'description' => '•La Nuova Vista is located in the best area New Cairo, the current destination for residential change. The project is accessible  through many main roads, which facilitates the access from the outside and into the project.
•Our location is really promising as it’s in the heart of New Cairo, surrounded by more than 25 residential compounds and   a lot of services and facilities from clubs to universities and hospitals.',
                'facilities' => '3 lanes Olympic pool Tennis court Fitness areas i.e. cross fit, 1 KM jogging track Mini Golf Leisure pool Jacuzzi Pool Bar & Café Yoga zone Seating areas i.e. beanbags, pergolas, chaise lounges Kids pool with mini water games Children’ outdoor playground Fitness area i.e. kids aerobics mini golf booking Sports training requests Information desk for fitness Towels for pool Mini cafeteria & Terrace seating Program & events officer',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:28:52',
                'updated_at' => '2016-01-12 22:39:12',
            ),
            7 => 
            array (
                'id' => 15,
                'name' => 'Mousa Coast',
                'district' => 10,
                'delivery_date' => '2018-12-01',
                'available' => 1,
                'description' => 'Mousa Coast is the nearest vacation destination on the Red Sea to Cairo, 90 minutes drive only – 150 km away. Its after Ahmed Hamdy Tunnel with 28 km, and before Ras Sudr with 30 km.',
                'facilities' => '- Bike Store - Water Sports - Sports Facilities - Beach Gym - Paint Ball Court - Internal Transportation - The Walk - Super Market - Clinic - Pharmacy - Home Appliances Stores - ATM Machine',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:34:25',
                'updated_at' => '2016-01-12 22:39:25',
            ),
            8 => 
            array (
                'id' => 16,
                'name' => 'Italian Square - Residential',
                'district' => 2,
                'delivery_date' => '2018-12-01',
                'available' => 1,
                'description' => 'Italian Square is situated in the prime position within 6th of October. Once described as the ‘City of the Present and the Future’, this is now a reality for investors, businesses and residents.

The nearby Ring Road and Axis Road bring Italian Square in easy reach of the Giza Pyramids, downtown Cairo, Remaya and Juhayna Squares.',
                'facilities' => 'Maintenance Security & Safety: Camera surveillance Canine units High qualified security personnel Fire fighting House-Keeping
',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:41:50',
                'updated_at' => '2016-01-12 22:41:50',
            ),
            9 => 
            array (
                'id' => 17,
                'name' => 'Kattameya Plaza',
                'district' => 3,
                'delivery_date' => '2016-01-12',
                'available' => 1,
                'description' => 'Kattameya Plaza marks a new standard in contemporary apartment living. It offers the perfect solution for those seeking to combine a healthy lifestyle with the comfort and security of a gated residential community and the amenities of a flourishing suburb.

Designed by world-class architects, landscape architects and interior designers, Kattameya Plaza provides a whole new quality of life.
',
                'facilities' => '- Swimming pools - Water features - GYM - Walkways through landscaped areas - Jogging track - Multi-purpose sports field - Recreational areas - Secure children\'s play areas - Underground parking
',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:44:28',
                'updated_at' => '2016-01-12 22:44:28',
            ),
            10 => 
            array (
                'id' => 18,
                'name' => 'Allegria',
                'district' => 7,
                'delivery_date' => '2016-01-12',
                'available' => 1,
            'description' => 'Allegria is located to the west of Cairo-Alexandria Desert Road, eight kilometers from Smart Village.It is next to British International School in Cairo(BISC), Beverly Hills and the Designopolis retail complex for home furniture and accessories.
',
                'facilities' => '',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:46:51',
                'updated_at' => '2016-01-12 22:47:21',
            ),
            11 => 
            array (
                'id' => 19,
                'name' => 'The Polygon - Administrative',
                'district' => 7,
                'delivery_date' => '2018-01-01',
                'available' => 1,
                'description' => 'With its strategic location, Westown is set to become Sheikh Zayed\'s preferred business location.. 

As anyone who has worked in Cairo knows, this variety of flexibility is in huge demand. The business district will feature \'Class A\' offices catering to all types of businesses, from global corporations to start-ups. Here, an office designed around your company\'s needs is more than simple wishful thinking. But for a more economic approach, large numbers of office floors will be available for purchase or lease; an ideal alternative for small outfits.

In addition, Westown\'s strategic location means it is uniquely placed to facilitate internships, business training and exchange programs between the academic and business worlds.',
                'facilities' => 'Wi – Fi internet cloud technology Health club Indoor and outdoor restaurants Serviced business Business hotel
',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-01-12 22:51:37',
                'updated_at' => '2016-01-12 22:52:21',
            ),
            12 => 
            array (
                'id' => 20,
                'name' => 'PALM VALLEY',
                'district' => 2,
                'delivery_date' => '2018-12-31',
                'available' => 1,
                'description' => '',
                'facilities' => '',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-03-16 15:09:12',
                'updated_at' => '2016-03-16 15:09:12',
            ),
            13 => 
            array (
                'id' => 21,
                'name' => 'Woodville',
                'district' => 2,
                'delivery_date' => '2018-12-31',
                'available' => 1,
                'description' => '',
                'facilities' => '',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-03-18 22:06:25',
                'updated_at' => '2016-03-18 22:06:25',
            ),
            14 => 
            array (
                'id' => 22,
                'name' => 'HYDE PARK',
                'district' => 3,
                'delivery_date' => '2019-10-01',
                'available' => 1,
                'description' => '',
                'facilities' => '',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2016-10-06 14:12:32',
                'updated_at' => '2016-10-06 14:12:32',
            ),
            15 => 
            array (
                'id' => 23,
                'name' => 'JEDAR',
                'district' => 2,
                'delivery_date' => '2017-02-19',
                'available' => 1,
            'description' => 'The name “JEDAR”, classical (Original) Arabic for “Wall”, reflects the simplistic concept that the compound offers; a true balanced home, after all a home is comprised of walls. A home is all about its walls, the way the walls are designed, the way the walls are utilized, and the way the walls make you feel sheltered and at home.',
                'facilities' => 'Club House -- 
Landscape & Water Features -- 
Commercial Strip -- ',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-02-19 10:01:48',
                'updated_at' => '2017-02-19 10:02:33',
            ),
            16 => 
            array (
                'id' => 24,
                'name' => 'ONE 16',
                'district' => 7,
                'delivery_date' => '2020-03-01',
                'available' => 1,
                'description' => 'SODIC is Finally lunching ONE 16! Centrally located amidst SODIC West’s residential developments and with only 123 residential units, homeowners can enjoy a sense of exclusivity in a peaceful atmosphere.

',
                'facilities' => 'Self-Catering Zone -- 
Central Lake --
Children’s pool --
Shade Structure --
Tent Structure --
Children’s Play Area --
Service Kiosk --
Outdoor Exercising Zone --
Grand Lawn Area --
Jogging track',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-03-05 17:27:14',
                'updated_at' => '2017-03-05 17:27:14',
            ),
            17 => 
            array (
                'id' => 25,
                'name' => 'Kenz Compound',
                'district' => 2,
                'delivery_date' => '2018-04-01',
                'available' => 1,
                'description' => 'Kenz development is located in October Gardens, 10 minutes from Al Remaya Sq. The location provides easy access to Giza, Cairo, Al Wahat road, 26th Jul Axis, the Cairo-Alex Desert road and the new regional ring road. 45 minutes from Lebanon Sq., 20 minutes from Hyper One and 15 minutes from Mall of Egypt.
',
            'facilities' => '80% from the total area of the gated ---- Neighborhood shopping and retail facility of approx ---- public gardens ---- Running tracks ---- Sports Club (Membership fees included in the unit price) ---- sustainable energy public lighting system',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-04-04 17:28:41',
                'updated_at' => '2017-04-04 17:28:41',
            ),
            18 => 
            array (
                'id' => 26,
                'name' => 'October Plaza',
                'district' => 2,
                'delivery_date' => '2017-04-19',
                'available' => 1,
                'description' => 'jgfy',
                'facilities' => 'hjfgc',
                'commision_percentag' => 0.0,
                'created_by' => 21,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-04-19 16:36:22',
                'updated_at' => '2017-04-19 16:36:22',
            ),
            19 => 
            array (
                'id' => 27,
                'name' => 'Ashgar City',
                'district' => 2,
                'delivery_date' => '2020-05-05',
                'available' => 1,
                'description' => '*City Flats* is a new product of Ashgar City 6 October, a 148 faddan gated community that offers a vast array of services and facilities.

This residential haven is designed to cater to our clients’ needs by gratifying all aspects of their physical and emotional well-being; a noise and pollution free environment, an assuring sense of security, a close-knit community, and a leisurely atmosphere for day-to-day activities.',
                'facilities' => 'Ashgar City Club - Commercial Strip -
Educational - Medical - Mosque',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-05-17 18:54:09',
                'updated_at' => '2017-05-17 18:54:09',
            ),
            20 => 
            array (
                'id' => 28,
                'name' => 'Bo Sands',
                'district' => 4,
                'delivery_date' => '2017-12-31',
                'available' => 1,
                'description' => '',
                'facilities' => '- Crystal Lagoons
- Club House
- 2 Hotels
- Transportations
- Commercial Strip
- Hospital ',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-07-20 15:54:26',
                'updated_at' => '2017-07-20 15:54:26',
            ),
            21 => 
            array (
                'id' => 29,
                'name' => 'SKY CONDOS',
                'district' => 3,
                'delivery_date' => '2020-07-01',
                'available' => 1,
                'description' => 'Villette’s Sky Condos new Cairo are sure to be a sight to behold for all residents and visitors.
As for our homeowners, they will not only fall in love with their unique spatial structure, but also the genuinely unparalleled atmosphere they will experience. With waving silhouettes, along with exclusive open space compositions and links, Villette’s Sky Condos new Cairo constitutes of a special urban development that enriches its surrounding scenery, adding to Villette’s general charm. Sky Condos new Cairo also overlooks Villette’s entertainment park, The Hive, one of four featured pocket parks in the development.',
                'facilities' => 'Bike Trail - Club House - Gym - Kids play grounds 
- Spa - Sports Area - Sports Facilities - Tennis Courts',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-07-24 19:06:43',
                'updated_at' => '2017-07-24 19:06:43',
            ),
            22 => 
            array (
                'id' => 30,
                'name' => 'BETA GREENS',
                'district' => 2,
                'delivery_date' => '2018-08-01',
                'available' => 1,
                'description' => 'Beta Greens is built on 20 acres area and includes 840 residential units, the proportion of 20% of the total area.
',
                'facilities' => 'Club House - Commercial Area - KIDS AREA - Sports Facilities - Swimming pool',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-08-06 16:42:33',
                'updated_at' => '2017-08-06 16:42:33',
            ),
            23 => 
            array (
                'id' => 31,
                'name' => 'GREEN5',
                'district' => 2,
                'delivery_date' => '2020-09-01',
                'available' => 1,
                'description' => 'Green 5, Mabany Edris’ latest development, is located at the heart of 6th of October; only 5 minutes away from Juhayna Square and Shooting Club. Green 5 is also very close to Nile University, Misr University, and 6th of October University.

Green 5 was designed to add a certain touch of beauty to the lives of its residents, as it balances between the dynamic practicalities and the beautiful aesthetics of design. The project is spread over 84.000 m², with a built-up area of only 25% of the whole area. Each unit in Green 5 has a spectacular view over the greenery and the rest of the project. The overall design for the entire project ensures privacy for all unit types, whether they are multiple leveled, ground floors with a garden view or third floor units with special rooftops.',
                'facilities' => 'Car Wash - Delivery Service - House keeping - Parking -
Security - Shopping Mall',
                'commision_percentag' => 2.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-09-25 17:30:54',
                'updated_at' => '2017-09-25 17:30:54',
            ),
            24 => 
            array (
                'id' => 32,
                'name' => 'Kai Sahel',
                'district' => 4,
                'delivery_date' => '2017-10-05',
                'available' => 1,
                'description' => 'Kai Sahel, One of the newest Misr Italia properties projects with many variety of unit types available of an impressive modern architectural designs.

',
                'facilities' => 'EDEN LAGOONS - HELE WATER - Hotel - KOMO CULTURE HUB -
SENSATIONS PARK - SPORTS ARENA',
                'commision_percentag' => 1.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-10-05 13:21:45',
                'updated_at' => '2017-10-05 13:21:45',
            ),
            25 => 
            array (
                'id' => 33,
                'name' => 'Caesar',
                'district' => 4,
                'delivery_date' => '2020-11-01',
                'available' => 1,
                'description' => 'Caesar North Coast captures the original essence of the Summer , the nostalgic meaning of a summer holiday, enjoying life’s simplest pleasures.

Caesar North Coast SODIC will take residents back in time, to the days of Agamy and Montazah, bringing back the timeless charm, simplicity and authenticity of the good old days. Promising a community of homes built on the Mediterranean Sea, with beachfront of over one kilometre, Caesar will offer one of the most exclusive residential communities on the North Coast.',
                'facilities' => '',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-11-02 16:45:50',
                'updated_at' => '2017-11-02 16:45:50',
            ),
            26 => 
            array (
                'id' => 34,
                'name' => 'Neopolis',
                'district' => 25,
                'delivery_date' => '2020-12-01',
                'available' => 1,
                'description' => 'Neopolis is the first of its kind city built by Wadi Degla Developments in Mostakbal City. Covering over 545.5 acres of land Neopolis City provides you with the most joyful view. We like to have our residents enjoy the scenery so our apartments and duplexes overlook wide green areas. Luxury and high end facilities and services are always offered including Wadi Degla Club and Wadi Degla’s well known retail complex: The District

',
                'facilities' => '',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => 7,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2017-12-29 17:09:01',
                'updated_at' => '2017-12-29 17:11:35',
            ),
            27 => 
            array (
                'id' => 35,
                'name' => 'IL BOSCO',
                'district' => 24,
                'delivery_date' => '2021-12-01',
                'available' => 1,
                'description' => '“Launching Soon In New Cairo Capital”
',
                'facilities' => '4 Club Houses - Club on 4 acre - Commercial Area ',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-01-08 16:34:04',
                'updated_at' => '2018-01-08 16:34:04',
            ),
            28 => 
            array (
                'id' => 36,
                'name' => 'SODIC EAST',
                'district' => 18,
                'delivery_date' => '2021-01-01',
                'available' => 1,
                'description' => 'Strategically located between two of Cairo’s main through ways, The Cairo Suez Road and the Cairo Ismailia Road,

SODIC East is directly adjacent to Al Sherouk City, and in close proximity to the new administrative Capital, as well as being easily connected to downtown Cairo, and just a few minutes’ drive from Cairo’s new regional ring road.',
                'facilities' => '',
                'commision_percentag' => 0.0,
                'created_by' => 7,
                'updated_by' => NULL,
                'last_updated' => NULL,
                'marked_deleted' => 0,
                'deleted_by' => NULL,
                'deleted_at' => NULL,
                'created_at' => '2018-01-17 12:59:08',
                'updated_at' => '2018-01-17 12:59:08',
            ),
        ));
        
        
    }
}