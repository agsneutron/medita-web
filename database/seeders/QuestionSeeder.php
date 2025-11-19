<?php

namespace Database\Seeders;

use App\Models\EducationalLevel;
use App\Models\Question;
use Illuminate\Database\Seeder;
use DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->instructions();
        $this->questions();
    }

    public function instructions()
    {
        DB::table('questions')->insert([
            ['id' => 1, 'description' => 'Por favor, califique cada una de las siguientes afirmaciones según la escala propuesta. Seleccione la opción en la frecuencia que describe de la mejor manera su opinión sobre cuán cierto es cada afirmación para usted.']
        ]);
        DB::table('questions')->where('id', 1)->update(['id' => 0]);
    }

    public function questions()
    {
        DB::table('questions')->insert([
            //Kinder
            [
                'id' => 1,
                'description' => 'Me juzgo por tener emociones “tontas”.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 2,
                'description' => 'Me doy cuenta de mis sentimientos y emociones sin reaccionar a ellos.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 3,
                'description' => 'Cuando estoy haciendo algo, me distraigo muy fácil.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 4,
                'description' => 'No pongo atención a lo que hago por estar soñando despierto, estar preocupado, o estar distraído.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 5,
                'description' => 'Observo mis sentimientos sin obsesionarme con ellos.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 6,
                'description' => 'A veces creo que no me debería estar sintiendo como me estoy sintiendo.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 7,
                'description' => 'Me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 8,
                'description' => 'Creo que algunos de mis pensamientos son malos y que no debería pensar así.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 9,
                'description' => 'Juzgo si mis pensamientos son buenos o malos.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 10,
                'description' => 'Se me hace difícil mantenerme concentrado en lo que está pasando.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 11,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, tomo una pausa y soy consciente de lo que estoy pensando sin dejar que me gane la emoción.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 12,
                'description' => 'Pongo atención a sonidos, como los de las manecillas de un reloj, los pájaros cantando, o los coches en pasando.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 13,
                'description' => 'Cuando tengo una sensación en mi cuerpo, es difícil describirla porque no puedo encontrar las palabras.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 14,
                'description' => 'Actúo en automático, sin pensar lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 15,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, me calmo al poco tiempo.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 16,
                'description' => 'Me apuro entre muchas actividades sin concentrarme en cada una de ellas.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 17,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, puedo darme cuenta de ellas sin reaccionar.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 18,
                'description' => 'Pienso que algunas de mis emociones son malas o raras, y que no debería sentirlas.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 19,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, puedo reconocerlos y dejarlos pasar.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 20,
                'description' => 'Hago mi tarea y actividades sólo por hacerlas, sin pensar en lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 21,
                'description' => 'Casi siempre puedo describir en detalle cómo me siento en diferentes momentos.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            [
                'id' => 22,
                'description' => 'Muchas veces hago cosas sin poner atención a lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::KINDERGARTEN
            ],
            //Primaria
            [
                'id' => 23,
                'description' => 'Me juzgo por tener emociones “tontas”.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 24,
                'description' => 'Me doy cuenta de mis sentimientos y emociones sin reaccionar a ellos.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 25,
                'description' => 'Cuando estoy haciendo algo, me distraigo muy fácil.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 26,
                'description' => 'No pongo atención a lo que hago por estar soñando despierto, estar preocupado, o estar distraído.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 27,
                'description' => 'Observo mis sentimientos sin obsesionarme con ellos.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 28,
                'description' => 'A veces creo que no me debería estar sintiendo como me estoy sintiendo.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 29,
                'description' => 'Me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 30,
                'description' => 'Creo que algunos de mis pensamientos son malos y que no debería pensar así.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 31,
                'description' => 'Juzgo si mis pensamientos son buenos o malos.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 32,
                'description' => 'Se me hace difícil mantenerme concentrado en lo que está pasando.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 33,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, tomo una pausa y soy consciente de lo que estoy pensando sin dejar que me gane la emoción.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 34,
                'description' => 'Pongo atención a sonidos, como los de las manecillas de un reloj, los pájaros cantando, o los coches en pasando.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 35,
                'description' => 'Cuando tengo una sensación en mi cuerpo, es difícil describirla porque no puedo encontrar las palabras.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 36,
                'description' => 'Actúo en automático, sin pensar lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 37,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, me calmo al poco tiempo.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 38,
                'description' => 'Me apuro entre muchas actividades sin concentrarme en cada una de ellas.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 39,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, puedo darme cuenta de ellas sin reaccionar.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 40,
                'description' => 'Pienso que algunas de mis emociones son malas o raras, y que no debería sentirlas.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 41,
                'description' => 'Cuando tengo pensamientos tristes o de angustia, puedo reconocerlos y dejarlos pasar.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 42,
                'description' => 'Hago mi tarea y actividades sólo por hacerlas, sin pensar en lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 43,
                'description' => 'Casi siempre puedo describir en detalle cómo me siento en diferentes momentos.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            [
                'id' => 44,
                'description' => 'Muchas veces hago cosas sin poner atención a lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::PRIMARY
            ],
            //Secundaria
            [
                'id' => 45,
                'description' => 'Me critico por tener emociones irracionales o inapropiadas.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 46,
                'description' => 'Percibo mis sentimientos y emociones sin tener que reaccionar ante ellos.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 47,
                'description' => 'Cuando hago algo mi mente tiende a divagar y me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 48,
                'description' => 'No presto atención a lo que hago por estar soñando despierto, andar preocupado, o distraído de alguna otra manera.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 49,
                'description' => 'Observo mis sentimientos sin perderme en ellos.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 50,
                'description' => 'Me digo a mí mismo que no me debería estar sintiendo como me estoy sintiendo.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 51,
                'description' => 'Me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 52,
                'description' => 'Creo que algunos de mis pensamientos no son normales o son malos, y que no debería pensar de tal manera.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 53,
                'description' => 'Hago juicios sobre si mis pensamientos son buenos o malos.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 54,
                'description' => 'Se me hace difícil mantenerme enfocado en lo que ocurre en el presente.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 55,
                'description' => 'Cuando experimento pensamientos o imágenes mentales aflictivas, me “detengo” y soy consciente del pensamiento o la imagen sin dejar que estos se apoderen de mí.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 56,
                'description' => 'En situaciones difíciles soy capaz de hacer una pausa sin tener que reaccionar inmediatamente.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 57,
                'description' => 'Parece que actúo en “piloto automático”, sin mayor conciencia de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 58,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, recobro la calma poco después.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 59,
                'description' => 'Me digo a mí mismo que no debería estar pensando como estoy pensando.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 60,
                'description' => 'Me apresuro entre una y otra actividad sin estar muy atento a cada una de ellas.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 61,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, soy capaz de observarlas sin reaccionar.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 62,
                'description' => 'Pienso que algunas de mis emociones son malas o inapropiadas, y que no debería sentirlas.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 63,
                'description' => 'Cuando tengo pensamientos o imágenes aflictivas, puedo reconocerlas como tales y dejarlas ir.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 64,
                'description' => 'Realizo deberes o tareas de manera automática sin estar consciente de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 65,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, me juzgo a mí mismo como bueno o malo, dependiendo del tipo de pensamiento o imagen mental.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 66,
                'description' => 'Me encuentro a mí mismo haciendo cosas sin prestarles atención.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            [
                'id' => 67,
                'description' => 'Me desapruebo cuando tengo ideas irracionales.',
                'educational_level_id' => EducationalLevel::SECONDARY
            ],
            //Preparatoria
            [
                'id' => 68,
                'description' => 'Me critico por tener emociones irracionales o inapropiadas.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 69,
                'description' => 'Percibo mis sentimientos y emociones sin tener que reaccionar ante ellos.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 70,
                'description' => 'Cuando hago algo mi mente tiende a divagar y me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 71,
                'description' => 'No presto atención a lo que hago por estar soñando despierto, andar preocupado, o distraído de alguna otra manera.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 72,
                'description' => 'Observo mis sentimientos sin perderme en ellos.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 73,
                'description' => 'Me digo a mí mismo que no me debería estar sintiendo como me estoy sintiendo.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 74,
                'description' => 'Me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 75,
                'description' => 'Creo que algunos de mis pensamientos no son normales o son malos, y que no debería pensar de tal manera.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 76,
                'description' => 'Hago juicios sobre si mis pensamientos son buenos o malos.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 77,
                'description' => 'Se me hace difícil mantenerme enfocado en lo que ocurre en el presente.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 78,
                'description' => 'Cuando experimento pensamientos o imágenes mentales aflictivas, me “detengo” y soy consciente del pensamiento o la imagen sin dejar que estos se apoderen de mí.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 79,
                'description' => 'En situaciones difíciles soy capaz de hacer una pausa sin tener que reaccionar inmediatamente.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 80,
                'description' => 'Parece que actúo en “piloto automático”, sin mayor conciencia de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 81,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, recobro la calma poco después.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 82,
                'description' => 'Me digo a mí mismo que no debería estar pensando como estoy pensando.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 83,
                'description' => 'Me apresuro entre una y otra actividad sin estar muy atento a cada una de ellas.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 84,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, soy capaz de observarlas sin reaccionar.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 85,
                'description' => 'Pienso que algunas de mis emociones son malas o inapropiadas, y que no debería sentirlas.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 86,
                'description' => 'Cuando tengo pensamientos o imágenes aflictivas, puedo reconocerlas como tales y dejarlas ir.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 87,
                'description' => 'Realizo deberes o tareas de manera automática sin estar consciente de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 88,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, me juzgo a mí mismo como bueno o malo, dependiendo del tipo de pensamiento o imagen mental.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 89,
                'description' => 'Me encuentro a mí mismo haciendo cosas sin prestarles atención.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            [
                'id' => 90,
                'description' => 'Me desapruebo cuando tengo ideas irracionales.',
                'educational_level_id' => EducationalLevel::HIGH_SCHOOL
            ],
            //Universidad
            [
                'id' => 91,
                'description' => 'Me critico por tener emociones irracionales o inapropiadas.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 92,
                'description' => 'Percibo mis sentimientos y emociones sin tener que reaccionar ante ellos.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 93,
                'description' => 'Cuando hago algo mi mente tiende a divagar y me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 94,
                'description' => 'No presto atención a lo que hago por estar soñando despierto, andar preocupado, o distraído de alguna otra manera.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 95,
                'description' => 'Observo mis sentimientos sin perderme en ellos.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 96,
                'description' => 'Me digo a mí mismo que no me debería estar sintiendo como me estoy sintiendo.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 97,
                'description' => 'Me distraigo fácilmente.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 98,
                'description' => 'Creo que algunos de mis pensamientos no son normales o son malos, y que no debería pensar de tal manera.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 99,
                'description' => 'Hago juicios sobre si mis pensamientos son buenos o malos.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 100,
                'description' => 'Se me hace difícil mantenerme enfocado en lo que ocurre en el presente.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 101,
                'description' => 'Cuando experimento pensamientos o imágenes mentales aflictivas, me “detengo” y soy consciente del pensamiento o la imagen sin dejar que estos se apoderen de mí.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 102,
                'description' => 'En situaciones difíciles soy capaz de hacer una pausa sin tener que reaccionar inmediatamente.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 103,
                'description' => 'Parece que actúo en “piloto automático”, sin mayor conciencia de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 104,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, recobro la calma poco después.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 105,
                'description' => 'Me digo a mí mismo que no debería estar pensando como estoy pensando.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 106,
                'description' => 'Me apresuro entre una y otra actividad sin estar muy atento a cada una de ellas.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 107,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, soy capaz de observarlas sin reaccionar.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 108,
                'description' => 'Pienso que algunas de mis emociones son malas o inapropiadas, y que no debería sentirlas.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 109,
                'description' => 'Cuando tengo pensamientos o imágenes aflictivas, puedo reconocerlas como tales y dejarlas ir.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 110,
                'description' => 'Realizo deberes o tareas de manera automática sin estar consciente de lo que estoy haciendo.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 111,
                'description' => 'Cuando tengo pensamientos o imágenes mentales aflictivas, me juzgo a mí mismo como bueno o malo, dependiendo del tipo de pensamiento o imagen mental.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 112,
                'description' => 'Me encuentro a mí mismo haciendo cosas sin prestarles atención.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
            [
                'id' => 113,
                'description' => 'Me desapruebo cuando tengo ideas irracionales.',
                'educational_level_id' => EducationalLevel::UNIVERSITY
            ],
        ]);
    }
}
