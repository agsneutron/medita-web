<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\EducationalLevel;
use App\Models\Program;
use Illuminate\Database\Seeder;
use DB;

class CatalogSeeder extends Seeder
{
    public function run()
    {
        $this->Answers();
        $this->Manuals();
        $this->Instructives();
        $this->Categories();
        $this->Phases();
        $this->EducationalLevels();
        $this->EmotionalStatistics();
        $this->Genders();
        $this->Levels();
        $this->Programs();
        $this->Restrictions();
        $this->Role();
        $this->Settings();
        $this->TypeClients();
        $this->CategoryProgram();
    }

    public function Answers()
    {
        DB::table('answers')->insert([
            ['id' => 1, 'name' => 'En absoluto'],
            ['id' => 2, 'name' => 'Poco'],
            ['id' => 3, 'name' => 'Bastante'],
            ['id' => 4, 'name' => 'Completamente'],
        ]);
    }

    public function Instructives()
    {
        DB::table('instructives')->insert([
            [
                'id' => 1,
                'title' => 'Recognition program - Instructivo',
                'description' => 'Instructivo para Recognition program',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 2,
                'title' => 'Lifefullness - Instructivo',
                'description' => 'Instructivo para Lifefullness',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 3,
                'title' => 'Work and wellness, Lifefullness Health - Instructivo',
                'description' => 'Instructivo para Work and wellness, Lifefullness Health',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 4,
                'title' => 'Audios alta tecnología - Instructivo',
                'description' => 'Instructivo para Audios alta tecnología',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 5,
                'title' => 'Meditaciones guiadas - Instructivo',
                'description' => 'Instructivo para Meditaciones guiadas',
                'url' => '/assets/files/anexo26.pdf'

            ],

        ]);
    }

    public function Manuals()
    {
        DB::table('manuals')->insert([
            [
                'id' => 1,
                'title' => 'Recognition program - Manual',
                'description' => 'Manual para Recognition program',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 2,
                'title' => 'Lifefullness - Manual',
                'description' => 'Manual para Lifefullness',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 3,
                'title' => 'Work and wellness, Lifefullness Health - Manual',
                'description' => 'Manual para Work and wellness, Lifefullness Health',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 4,
                'title' => 'Audios alta tecnología - Manual',
                'description' => 'Manual para Audios alta tecnología',
                'url' => '/assets/files/anexo26.pdf'
            ],
            [
                'id' => 5,
                'title' => 'Meditaciones guiadas - Manual',
                'description' => 'Manual para Meditaciones guiadas',
                'url' => '/assets/files/anexo26.pdf'
            ],

        ]);
    }

    public function Categories()
    {
        DB::table('categories')->insert([
            [
                'id' => 1,
                'name' => 'Recognition program',
                'url_image' => '/assets/image/category1.png',
                'description' => 'Escaneo corporal para comenzar a meditar...',
                'url_manual' => '/assets/client/recognitions_program/manual/recognitions_program_manual.pdf',
                'url_instructive' => '/assets/client/recognitions_program/instructive/recognitions_program_instructive.pdf',

            ],
            [
                'id' => 2,
                'name' => 'Lifefullness (Kínder)',
                'url_image' => '/assets/image/kinder.png',
                'description' => 'Kids',
                'url_manual' => '/assets/client/lifefullness_kinder/manual/lifefullness_manual_kinder.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 3,
                'name' => 'Lifefullness (Primaria)',
                'url_image' => '/assets/image/primaria.jpg',
                'description' => 'Primaria',
                'url_manual' => '/assets/client/lifefullness_primary/manual/lifefullness_manual_primaria.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 4,
                'name' => 'Lifefullness (Secundaria)',
                'url_image' => '/assets/image/secundaria.png',
                'description' => 'Secundaria',
                'url_manual' => '/assets/client/lifefullness_secondary/manual/lifefullness_manual_secundaria.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 5,
                'name' => 'Lifefullness (Preparatoria)',
                'url_image' => '/assets/image/prepa.jpg',
                'description' => 'Preparatoria',
                'url_manual' => '/assets/client/lifefullness_high/manual/lifefullness_manual_prepa.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 6,
                'name' => 'Lifefullness (Universidad)',
                'url_image' => '/assets/image/universidad.png',
                'description' => 'Universidad',
                'url_manual' => '/assets/files/anexo26.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 7,
                'name' => 'Work and wellness, Lifefullness Health',
                'url_image' => '/assets/image/wwlh.png',
                'description' => 'Escaneo corporal para comenzar a meditar...',
                'url_manual' => '/assets/files/anexo26.pdf',
                'url_instructive' => null,
            ],
            [
                'id' => 8,
                'name' => 'Audios alta tecnología',
                'url_image' => '/assets/image/category4.png',
                'description' => 'Meditación guiada por música',
                'url_manual' => null,
                'url_instructive' => '/assets/client/atm/instructive/atm_instructive.pdf'
            ],
            [
                'id' => 9,
                'name' => 'Meditaciones guiadas',
                'url_image' => '/assets/image/category5.png',
                'description' => 'Establecer hábitos para furfear tu día',
                'url_manual' => null,
                'url_instructive' => null,
            ],
        ]);
    }

    public function Phases()
    {
        DB::table('phases')->insert([
            //Recognition
            [
                'id' => 1,
                'name' => 'Fase 1',
                'url_image' => '/assets/image/fase1.png',
                'description' => 'Escaneo corporal para comenzar a meditar...',
                'category_id' => 1,
                'price' => 1500
            ],
            [
                'id' => 2,
                'name' => 'Fase 2',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Meditacion Guiada por musica',
                'category_id' => 1,
                'price' => 1500
            ],
            [
                'id' => 3,
                'name' => 'Fase 3',
                'url_image' => '/assets/image/fase3.png',
                'description' => 'Establecer habitos para furfear tu dia',
                'category_id' => 1,
                'price' => 1500
            ],
            //Lifefullness Kínder
            [
                'id' => 4,
                'name' => 'Fase 1: Técnicas de respiración',
                'url_image' => '/assets/image/fase1.png',
                'description' => '10 sesiones con breves ejercicios de respiración y temas de identificación para niños sobre aspectos de su personalidad y de su cuerpo para conectarse consigo mismos desde un enfoque holístico.',
                'category_id' => 2,
                'price' => null
            ],
            [
                'id' => 5,
                'name' => 'Fase 2: Técnicas de mindfulness',
                'url_image' => '/assets/image/fase2.png',
                'description' => '10 sesiones con breves ejercicios de visualizaciones y temas de reflexión para niños que permiten estimular la conexión cognitiva a las indicaciones que se les pide desarrollar desde cierto nivel de conciencia',
                'category_id' => 2,
                'price' => null
            ],
            [
                'id' => 6,
                'name' => 'Fase 3: Técnicas de programación neurolingüística e intenciones.',
                'url_image' => '/assets/image/fase3.png',
                'description' => '10 sesiones con breves ejercicios de programación neurolingüística y temas de intenciones para niños que desarrollará un mejor control emocional y tener pensamientos positivos impulsando un cambio de conducta.',
                'category_id' => 2,
                'price' => null
            ],
//            [
//                'id' => 7,
//                'name' => 'Fase 4',
//                'url_image' => '/assets/image/fase1.png',
//                'description' => 'Lifefullness - Fase 4',
//                'category_id' => 2,
//                'price' => null
//            ],
            //Lifefullness Primaria
            [
                'id' => 8,
                'name' => 'Fase 1: Técnicas de respiración',
                'url_image' => '/assets/image/fase1.png',
                'description' => '12 sesiones con breves ejercicios de respiración y temas de identificación para niños sobre aspectos de su personalidad y de su cuerpo para conectarse consigo mismos desde un enfoque holístico. ',
                'category_id' => 3,
                'price' => null
            ],
            [
                'id' => 9,
                'name' => 'Fase 2: Técnicas de mindfulness',
                'url_image' => '/assets/image/fase2.png',
                'description' => '12 sesiones con breves ejercicios de visualizaciones y temas de reflexión para niños que permiten estimular la conexión cognitiva a las indicaciones que se les pide desarrollar desde cierto nivel de conciencia.',
                'category_id' => 3,
                'price' => null
            ],
            [
                'id' => 10,
                'name' => 'Fase 3: Técnicas de programación neurolingüística e intenciones',
                'url_image' => '/assets/image/fase3.png',
                'description' => '24 sesiones con breves ejercicios de programación neurolingüìstica y temas de intenciones para niños que desarrollará un mejor control emocional y tener pensamiento positivos impulsando un cambio de conducta.',
                'category_id' => 3,
                'price' => null
            ],
//            [
//                'id' => 11,
//                'name' => 'Fase 4',
//                'url_image' => '/assets/image/fase1.png',
//                'description' => 'Lifefullness - Fase 4',
//                'category_id' => 3,
//                'price' => null
//            ],
            //Lifefullness Secundaria
            [
                'id' => 12,
                'name' => 'Fase 1: Técnicas de respiración',
                'url_image' => '/assets/image/fase1.png',
                'description' => '9 sesiones con breves ejercicios de respiración y temas de identificación para adolescentes sobre aspectos de su personalidad y de su cuerpo para conectarse consigo mismos desde un enfoque holístico. ',
                'category_id' => 4,
                'price' => null
            ],
            [
                'id' => 13,
                'name' => 'Fase 2: Técnicas de mindfulness',
                'url_image' => '/assets/image/fase2.png',
                'description' => '8 sesiones con breves ejercicios de visualizaciones y temas de reflexión para adolescentes que permiten estimular la conexión cognitiva a las indicaciones que se les pide desarrollar desde cierto nivel de conciencia',
                'category_id' => 4,
                'price' => null
            ],
            [
                'id' => 14,
                'name' => 'Fase 3: Técnicas de programación neurolingüística e intenciones ',
                'url_image' => '/assets/image/fase3.png',
                'description' => '30 sesiones con breves ejercicios de programación neurolingüìstica y temas de intenciones para adolescentes que desarrollará un mejor control emocional y tener pensamiento positivos impulsando un cambio de conducta.',
                'category_id' => 4,
                'price' => null
            ],
//            [
//                'id' => 15,
//                'name' => 'Fase 4',
//                'url_image' => '/assets/image/fase1.png',
//                'description' => 'Lifefullness - Fase 4',
//                'category_id' => 4,
//                'price' => null
//            ],
            //Lifefullness Preparatoria
            [
                'id' => 16,
                'name' => 'Fase 1: Técnicas de respiración',
                'url_image' => '/assets/image/fase1.png',
                'description' => '9 sesiones con breves ejercicios de respiración y temas de identificación para adolescentes sobre aspectos de su personalidad y de su cuerpo para conectarse consigo mismos desde un enfoque holístico. ',
                'category_id' => 5,
                'price' => null
            ],
            [
                'id' => 17,
                'name' => 'Fase 2: Técnicas de mindfulness',
                'url_image' => '/assets/image/fase2.png',
                'description' => '8 sesiones con breves ejercicios de visualizaciones y temas de reflexión para adolescentes que permiten estimular la conexión cognitiva a las indicaciones que se les pide desarrollar desde cierto nivel de conciencia',
                'category_id' => 5,
                'price' => null
            ],
            [
                'id' => 18,
                'name' => 'Fase 3: Técnicas de programación neurolingüística e intenciones ',
                'url_image' => '/assets/image/fase3.png',
                'description' => '15 sesiones con breves ejercicios de programación neurolingüística y temas de intenciones para adolescentes que desarrollará un mejor control emocional y tener pensamientos positivos impulsando un cambio de conducta.',
                'category_id' => 5,
                'price' => null
            ],
//            [
//                'id' => 19,
//                'name' => 'Fase 4',
//                'url_image' => '/assets/image/fase1.png',
//                'description' => 'Lifefullness - Fase 4',
//                'category_id' => 5,
//                'price' => null
//            ],
            //Lifefullness Universidad
            [
                'id' => 20,
                'name' => 'Fase 1',
                'url_image' => '/assets/image/fase1.png',
                'description' => 'Lifefullness - Fase 1',
                'category_id' => 6,
                'price' => null
            ],
            [
                'id' => 21,
                'name' => 'Fase 2',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Lifefullness - Fase 2',
                'category_id' => 6,
                'price' => null
            ],
            [
                'id' => 22,
                'name' => 'Fase 3',
                'url_image' => '/assets/image/fase3.png',
                'description' => 'Lifefullness - Fase 3',
                'category_id' => 6,
                'price' => null
            ],
//            [
//                'id' => 23,
//                'name' => 'Fase 4',
//                'url_image' => '/assets/image/fase1.png',
//                'description' => 'Lifefullness - Fase 4',
//                'category_id' => 6,
//                'price' => null
//            ],

            //Alta Tecnología
            [
                'id' => 25,
                'name' => 'Tecnologia Alpha',
                'url_image' => '/assets/image/phase_alpha.png',
                'description' => 'Escaneo corporal para comenzar a meditar...',
                'category_id' => 8,
                'price' => null
            ],
            [
                'id' => 26,
                'name' => 'Tecnologia Theta',
                'url_image' => '/assets/image/phase_theta.png',
                'description' => 'Establecer habitos para furfear tu dia',
                'category_id' => 8,
                'price' => null
            ],
            //Meditaciones Guiadas
            [
                'id' => 27,
                'name' => 'Comenzando a meditar',
                'url_image' => '/assets/image/medgui1.jpg',
                'description' => 'Inicia tu práctica y aprende técnicas de meditación básica.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 28,
                'name' => 'Programa 21 días de conectar',
                'url_image' => '/assets/image/medgui2.jpg',
                'description' => 'Conectar incrementa nuestra consciencia y permite que estemos conscientes con la forma en que suceden las cosas.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 29,
                'name' => 'Programa 21 días de bienestar',
                'url_image' => '/assets/image/medgui3.jpg',
                'description' => 'Influye en tu bienestar repitiendo afirmaciones positivas en meditación.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 30,
                'name' => 'Programa 21 días de técnicas de respiración',
                'url_image' => '/assets/image/medgui4.jpg',
                'description' => 'La energía nos da la energía vital para sobrevivir, sin embargo, existen técnicas de respiración que nos ayudan a potencializar sus beneficios.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 31,
                'name' => 'Programa de gratitud',
                'url_image' => '/assets/image/medgui5.jpg',
                'description' => 'La gratitud es la puerta de escape de la negatividad hacia lo positivo. Si practicas la gratitud estarás construyendo una fortaleza dentro de ti.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 32,
                'name' => 'Programa 21 dias de aceptación',
                'url_image' => '/assets/image/medgui6.jpg',
                'description' => 'La aceptación nos permite ver el mundo tal y como es pero con una perspectiva de compasión que genera sensaciones de paz y tranquilidad.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 33,
                'name' => 'Programa 21 días de mantras',
                'url_image' => '/assets/image/medgui7.jpg',
                'description' => 'Los mantras son sílabas cuya vibración es tan alta que se consideran sagradas. Repetirlas, especialmente en meditación, permite enfocar la mente hacia los objetivos que queremos alcanzar en nuestra vida y cultivar actitudes que nos llevan al bienestar.',
                'category_id' => 9,
                'price' => null
            ],
            [
                'id' => 34,
                'name' => 'Programa 10 días de paz interior',
                'url_image' => '/assets/image/medgui8.jpg',
                'description' => 'Apóyate de estas meditaciones guiadas para reconectar con la paz que ya existe en tu interior.',
                'category_id' => 9,
                'price' => null
            ]
        ]);
    }

    public function EducationalLevels()
    {
        DB::table('educational_levels')->insert([
            ['id' => 1, 'name' => 'Kínder'],
            ['id' => 2, 'name' => 'Primaria'],
            ['id' => 3, 'name' => 'Secundaria'],
            ['id' => 4, 'name' => 'Preparatoria'],
            ['id' => 5, 'name' => 'Universidad'],
        ]);
    }

    public function EmotionalStatistics()
    {
        DB::table('emotional_statistics')->insert([
            ['id' => 1, 'name' => 'Dormir mejor'],
            ['id' => 2, 'name' => 'Reducir ansiedad'],
            ['id' => 3, 'name' => 'Aprender a meditar'],
            ['id' => 4, 'name' => 'Certificarme en meditación'],
            ['id' => 5, 'name' => 'Otra'],
        ]);
    }

    public function Genders()
    {
        DB::table('genders')->insert([
            ['id' => 1, 'name' => 'Masculino'],
            ['id' => 2, 'name' => 'Femenino'],
            ['id' => 3, 'name' => 'Otro'],
        ]);
    }

    public function Levels()
    {
        DB::table('levels')->insert([
            //Kinder
            ['name' => 'Primer grado', 'educational_level_id' => EducationalLevel::KINDERGARTEN],
            ['name' => 'Segundo grado', 'educational_level_id' => EducationalLevel::KINDERGARTEN],
            ['name' => 'Tercer grado', 'educational_level_id' => EducationalLevel::KINDERGARTEN],
            //Primary
            ['name' => 'Primer grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            ['name' => 'Segundo grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            ['name' => 'Tercer grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            ['name' => 'Cuarto grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            ['name' => 'Quinto grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            ['name' => 'Sexto grado', 'educational_level_id' => EducationalLevel::PRIMARY],
            //Secondary
            ['name' => 'Primer grado', 'educational_level_id' => EducationalLevel::SECONDARY],
            ['name' => 'Segundo grado', 'educational_level_id' => EducationalLevel::SECONDARY],
            ['name' => 'Tercer grado', 'educational_level_id' => EducationalLevel::SECONDARY],
            //Preparatory
            ['name' => 'Primer semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            ['name' => 'Segundo semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            ['name' => 'Tercer semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            ['name' => 'Cuarto semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            ['name' => 'Quinto semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            ['name' => 'Sexto semestre', 'educational_level_id' => EducationalLevel::HIGH_SCHOOL],
            //University
            ['name' => 'Primer semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Segundo semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Tercer semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Cuarto semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Quinto semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Sexto semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Septimo semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Octavo semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Noveno semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
            ['name' => 'Décimo semestre', 'educational_level_id' => EducationalLevel::UNIVERSITY],
        ]);
    }

    public function Programs()
    {
        DB::table('programs')->insert([
            ['id' => 1, 'name' => 'Recognitions program'],
            ['id' => 2, 'name' => 'Lifefullness'],
            ['id' => 3, 'name' => 'Work and wellness'],
            ['id' => 4, 'name' => 'Lifefulness Health'],
        ]);
    }

    public function Restrictions()
    {
        DB::table('restrictions')->insert([
            ['id' => 1, 'name' => 'Reproducción en lista'],
            ['id' => 2, 'name' => 'Sin restricción'],
        ]);
    }

    public function Role()
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Administrador'],
            ['id' => 2, 'name' => 'Vendedor'],
        ]);
    }

    public function Settings()
    {
        DB::table('settings')->insert([
            ['id' => 1, 'name' => 'Noticias', 'content' => null],
            ['id' => 4, 'name' => 'Nivel y grado de estudios', 'content' => null],
        ]);
    }

    public function TypeClients()
    {
        DB::table('type_clients')->insert([
            ['id' => 1, 'name' => 'Escuelas'],
            ['id' => 2, 'name' => 'Empresas'],
            ['id' => 3, 'name' => 'Hospitales'],
        ]);
    }

    public function CategoryProgram()
    {
        DB::table('category_program')->insert([
            //Recognitions - Material
            ['id' => 1, 'category_id' => Category::RECOGNITIONS_PROGRAM, 'program_id' => Program::RECOGNITIONS_PROGRAM],
            ['id' => 2, 'category_id' => Category::HIGH_TECH_AUDIO, 'program_id' => Program::RECOGNITIONS_PROGRAM],
            ['id' => 3, 'category_id' => Category::MEDITATIONS_GUIDED, 'program_id' => Program::RECOGNITIONS_PROGRAM],
            //Lifefullness - Material
            ['id' => 4, 'category_id' => Category::LIFE_FULLNESS_KINDERGARTEN, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 5, 'category_id' => Category::LIFE_FULLNESS_PRIMARY, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 6, 'category_id' => Category::LIFE_FULLNESS_SECONDARY, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 7, 'category_id' => Category::LIFE_FULLNESS_HIGH_SCHOOL, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 8, 'category_id' => Category::LIFE_FULLNESS_UNIVERSITY, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 9, 'category_id' => Category::HIGH_TECH_AUDIO, 'program_id' => Program::LIFEFULLNESS],
            ['id' => 10, 'category_id' => Category::MEDITATIONS_GUIDED, 'program_id' => Program::LIFEFULLNESS],
            //Work and Wellness - Material
            ['id' => 11, 'category_id' => Category::WWLH, 'program_id' => Program::WORK_AND_WELLNESS],
            ['id' => 12, 'category_id' => Category::HIGH_TECH_AUDIO, 'program_id' => Program::WORK_AND_WELLNESS],
            ['id' => 13, 'category_id' => Category::MEDITATIONS_GUIDED, 'program_id' => Program::WORK_AND_WELLNESS],
            //Health - Material
            ['id' => 14, 'category_id' => Category::WWLH, 'program_id' => Program::LIFE_FULLNESS_HEALTH],
            ['id' => 15, 'category_id' => Category::HIGH_TECH_AUDIO, 'program_id' => Program::LIFE_FULLNESS_HEALTH],
            ['id' => 16, 'category_id' => Category::MEDITATIONS_GUIDED, 'program_id' => Program::LIFE_FULLNESS_HEALTH],
        ]);
    }
}
