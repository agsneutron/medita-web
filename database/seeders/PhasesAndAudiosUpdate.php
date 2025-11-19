<?php

namespace Database\Seeders;

use App\Models\Restriction;
use Illuminate\Database\Seeder;
use DB;

class PhasesAndAudiosUpdate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->NewPhases();
        $this->lifefullness_university_one();
        $this->lifefullness_university_two();
        $this->lifefullness_university_three();
        $this->work_wellness_lifefullness_health_meditation();
        $this->work_wellness_lifefullness_health_chemotherapy();
        $this->work_wellness_lifefullness_health_forgive();
        $this->work_wellness_lifefullness_health_acceptance();
        $this->work_wellness_lifefullness_health_heal_my_mind();
        $this->work_wellness_lifefullness_health_heal_my_emotions();
        $this->work_wellness_lifefullness_health_resilience();
        $this->work_wellness_lifefullness_health_heal_my_body();
        $this->work_wellness_lifefullness_health_gratitude();
        $this->meditations_guided_21_mantras();
        $this->meditations_guided_gratitude();
    }
    public function NewPhases()
    {
        DB::table('phases')->insert([
            //WWLH
            [
                'id' => 35,
                'name' => 'MEDITACIÓN',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Conoce los puntos importantes a tener en cuenta en una practica de meditacion a traves de la guia de una.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 36,
                'name' => 'QUIMIOTERAPIA',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Relajar el cuerpo y la mente mientras estás tomando tu medicamento ayuda q liberar tensión y estrés al mismo tiempo que resignificas el efecto negativo de la quimioterapia haciéndote parte activa de tu proceso clínico.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 37,
                'name' => 'PERDÓN',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Me perdono a mi mismo por todo lo que he hecho, sentido, pensado, por aquellos a los que herí y me hirieron, perdono a mi familia, mis padres, abuelos, hermanos o cualquier persona que considere familia y hogar.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 38,
                'name' => 'ACEPTACIÓN',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Acepto mi realidad tal y como es, para desde ahí moverme de lugar hacia la salud. Acepto las bendiciones escondidas que no puedo ver, me amo y me acepto tal cual soy y como estoy.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 39,
                'name' => 'SANAR MI MENTE',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Empiezo a darme cuenta de mis pensamientos, entiendo que no soy ellos, no me definen, tengo la posibilidad de notarlos bservarlos y desindentificarme de las emociones que los acompañan. Empiezo a notar todos aquellos pensamientos que no contribuyen a mi sanación y los dejo ir, trabajo con amor en construir pensamientos sanos en pro de mi bienestar',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 40,
                'name' => 'SANAR MIS EMOCIONES',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Dejo ir las emociones que me hacen daño, que me contaminan y no me ayudan a sanar, dejo ir recuerdos desagradables o que bajan mi estado de ánimo. Me enfoco en generar emociones peositivas y elevar mi vibración para sanar. No juzgo mi proceso, no es bueno o malo, no he fracasado, simplemente es como lo vivo y así lo acepto. No me comparo ni critico a otros porque sé que también tienen situaciones y emociones con las que lidiar.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 41,
                'name' => 'RESILIENCIA',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Me veo con amor y sé que tengo la fortaleza para hacer lo que me corresponde aunque a veces lo dude y sienta que no puedo más. Me doy permiso de hacer un alto y recargarme nuevamente para continuar.',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 42,
                'name' => 'SANAR MI CUERPO',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Nutro mi cuerpo con alimentos y emocionaes sanas que me ayuden a sentirme bien, porque me quiero y me respeto elimino aquello que no contribuye a mi proceso de sanación. ',
                'category_id' => 7,
                'price' => null
            ],
            [
                'id' => 43,
                'name' => 'AGRADECIMIENTO',
                'url_image' => '/assets/image/fase2.png',
                'description' => 'Aprender que el agradecimiento es una forma de mantener la mente positiva enfocandonos en las cosas que si tenemos, esto mejora nuestra actitud y la actitud apoya de mejor forma el proceso clínico.',
                'category_id' => 7,
                'price' => null
            ],
        ]);
    }
    public function lifefullness_university_one()
    {
        DB::table('audios')->insert([
            [
                'id' => 272, 'number' => 1, 'name' => '1 Contar la respiración', 'price' => 0, 'duration' => '591',
                'description' => 'Nombre: 1 Contar la respiración, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/1. LFU. Técnica Contar la Respiración.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 273, 'number' => 2, 'name' => '2 Respiración de activación celular', 'price' => 0, 'duration' => '736',
                'description' => 'Nombre: 2 Respiración de activación celular, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/2. LFU. Técnica Respiración de activación celular.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_2.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Oxigenando_hemisferios_cerebrales_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 274, 'number' => 3, 'name' => '3 Respiración alternada', 'price' => 0, 'duration' => '733',
                'description' => 'Nombre: 3 Respiración alternada, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/3. Técnica de Respiración alternada.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respiracion_activa_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 275, 'number' => 4, 'name' => '4 Respiración del Yo', 'price' => 0, 'duration' => '648',
                'description' => 'Nombre: 4 Respiración del Yo, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/4. LFU. Técnica Respiración del Yo.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_4.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Activa_las_defensas_de_tu_cuerpo_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 276, 'number' => 5, 'name' => '5 Oxigenando mis hemisferios cerebrales', 'price' => 0, 'duration' => '687',
                'description' => 'Nombre: 5 Oxigenando mis hemisferios cerebrales, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/5. Técnica Oxigenando mis hemisferios cerebrales.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_5.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Enfoca_tu_respiracion_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 277, 'number' => 6, 'name' => '6 Respiración de aspiradora', 'price' => 0, 'duration' => '702',
                'description' => 'Nombre: 6 Respiración de aspiradora, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/6. LFU. Técnica Respiración de Aspiradora.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Mejora_tu_circulacion_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 278, 'number' => 7, 'name' => '7 Activa las defensas de tu cuerpo', 'price' => 0, 'duration' => '804',
                'description' => 'Nombre: 7 Activa las defensas de tu cuerpo , Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/7. LFU. Técnica activa las defensas de tu cuerpo.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_2.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respiracion_revitalizante_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ],
            [
                'id' => 279, 'number' => 8, 'name' => '8 Mejora tu circulación', 'price' => 0, 'duration' => '778',
                'description' => 'Nombre: 8 Mejora tu circulación, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_1/audio/8. LFU. Técnica Mejora tu circulación.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 20,
            ]
        ]);
    }
    public function lifefullness_university_two()
    {
        DB::table('audios')->insert([
            [
                'id' => 280, 'number' => 1, 'name' => '1 Abrazo mis emociones', 'price' => 0, 'duration' => '735',
                'description' => 'Nombre: 1 Abrazo mis emociones, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/1. LFU. MEDITACIÓN DE INTENCIÓN 1.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 281, 'number' => 2, 'name' => '2 Aprendo a tolerar la frustración', 'price' => 0, 'duration' => '718',
                'description' => 'Nombre: 2 Aprendo a tolerar la frustración, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/2. LFU. MEDITACIÓN DE INTENCIÓN 2.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_2.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Oxigenando_hemisferios_cerebrales_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 282, 'number' => 3, 'name' => '3 Personas vitamina', 'price' => 0, 'duration' => '749',
                'description' => 'Nombre: 3 Personas vitamina, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/3. LFU. MEDITACIÓN DE INTENCIÓN 3.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respiracion_activa_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 283, 'number' => 4, 'name' => '4 Cuido mis pensamientos', 'price' => 0, 'duration' => '883',
                'description' => 'Nombre: 4 Cuido mis pensamientos, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/4. LFU. MEDITCIÓN DE INTENCIÓN 4.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_4.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Activa_las_defensas_de_tu_cuerpo_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 284, 'number' => 5, 'name' => '5 Cultivo la gratitud', 'price' => 0, 'duration' => '752',
                'description' => 'Nombre: 5 Cultivo la gratitud, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/5. LFU. MEDITACIÓN DE INTENCIÓN 5.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_5.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Enfoca_tu_respiracion_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 285, 'number' => 6, 'name' => '6 El valor de la insertidumbre', 'price' => 0, 'duration' => '768',
                'description' => 'Nombre: 6 El valor de la insertidumbre, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/6. LFU. MEDITACIÓN DE INTENCIÓN 6.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Mejora_tu_circulacion_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 286, 'number' => 7, 'name' => '7 Me dejo guiar', 'price' => 0, 'duration' => '675',
                'description' => 'Nombre:  7 Me dejo guiar, Lifefullness - uni - Fase 1',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/7. LFU. MEDITACIÓN DE INTENCIÓN 7.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_2.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respiracion_revitalizante_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 287, 'number' => 8, 'name' => '8 Me libero de una calificación', 'price' => 0, 'duration' => '627',
                'description' => 'Nombre: 8 Me libero de una calificación, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/8. LFU. MEDITACIÓN DE INTENCIÓN 8.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 288, 'number' => 9, 'name' => '9 El talento de los demás', 'price' => 0, 'duration' => '721',
                'description' => 'Nombre: 9 El talento de los demás, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/9. LFU. MEDITACIÓN DE INTENCIÓN 9.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 289, 'number' => 10, 'name' => '10 Mi etapa universitaria', 'price' => 0, 'duration' => '639',
                'description' => 'Nombre: 10 Mi etapa universitaria, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/10. LFU. MEDITACIÓN DE INTENCIÓN 10.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 290, 'number' => 11, 'name' => '11 El silencio', 'price' => 0, 'duration' => '620',
                'description' => 'Nombre: 11 El silencio, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/11. LFU. MEDIACIÓN DE INTENCIÓN 11.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ],
            [
                'id' => 291, 'number' => 12, 'name' => '12 Mi cuerpo energético', 'price' => 0, 'duration' => '616',
                'description' => 'Nombre: 12 Mi cuerpo energético, Lifefullness - uni - Fase 2',
                'url_audio' => '/assets/client/lifefullness_university/phase_2/audio/12. LFU. MEDITACIÓN DE INTENCIÓN 12.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_3.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Cuidando_el_trebol_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 21,
            ]
        ]);
    }
    public function lifefullness_university_three()
    {
        DB::table('audios')->insert([
            [
                'id' => 292, 'number' => 1, 'name' => '1 Lluvia y sentimiento', 'price' => 0, 'duration' => '478',
                'description' => 'Nombre: 1 Lluvia y sentimiento, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/1. LFU. LLUVIA Y SENTIMIENTO.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 293, 'number' => 2, 'name' => '2 Las sensaciones', 'price' => 0, 'duration' => '576',
                'description' => 'Nombre: 2 Las sensaciones, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/2. LFU. LAS SENSACIONES.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 294, 'number' => 3, 'name' => '3 Eligiendo emociones', 'price' => 0, 'duration' => '356',
                'description' => 'Nombre: 3 Eligiendo emociones, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/3. LFU. ELIGIENDO EMOCIONES.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 295, 'number' => 4, 'name' => '4 Respirar y agradacer', 'price' => 0, 'duration' => '482',
                'description' => 'Nombre: 4 Respirar y agradacer, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/4. LFU. RESPIRAR Y AGRADECER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 296, 'number' => 5, 'name' => '5 Potencial ilimitado', 'price' => 0, 'duration' => '482',
                'description' => 'Nombre: 5 Potencial ilimitado, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/5. LFU. POTENCIAL ILIMITADO.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 297, 'number' => 6, 'name' => '6 El amor a la naturaleza', 'price' => 0, 'duration' => '538',
                'description' => 'Nombre: 6 El amor a la naturaleza, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/6. LFU. EL AMOR A LA NATURALEZA - JJ.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 298, 'number' => 7, 'name' => '7 El sentir', 'price' => 0, 'duration' => '614',
                'description' => 'Nombre: 7 El sentir, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/7. LFU. EL SENTIR - JJ.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ],
            [
                'id' => 299, 'number' => 8, 'name' => '8 Explorar nuestros sentidos', 'price' => 0, 'duration' => '396',
                'description' => 'Nombre: 8 Explorar nuestros sentidos, Lifefullness - uni - Fase 3',
                'url_audio' => '/assets/client/lifefullness_university/phase_3/audio/8. LFU. EXPLORAR NUESTROS SENTIDOS - ILY.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 22,
            ]
        ]);
    }
    public function work_wellness_lifefullness_health_meditation()
    {
        DB::table('audios')->insert([
            [
                'id' => 300, 'number' => 1, 'name' => 'Sophie, tu guía de meditación', 'price' => 0, 'duration' => '1262',
                'description' => 'Nombre: Sophie, tu guía de meditación, Work Wellness Lifefulllnes Health - Fase: Meditacion',
                'url_audio' => '/assets/client/work_wellness_health/audio/1. GUIA DE MEDITACION.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 35,
            ],
            [
                'id' => 301, 'number' => 2, 'name' => 'Xerónimo, tu guía de meditación', 'price' => 0, 'duration' => '1146',
                'description' => 'Nombre: Xerónimo, tu guía de meditación, Work Wellness Lifefulllnes Health - Fase: Meditacion',
                'url_audio' => '/assets/client/work_wellness_health/audio/1.2 GUIA DE MEDITACION XERONIMO MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 35,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_chemotherapy()
    {
        DB::table('audios')->insert([
            [
                'id' => 302, 'number' => 1, 'name' => 'Salas de Quimioterapia 1', 'price' => 0, 'duration' => '1159',
                'description' => 'Nombre: Salas de Quimioterapia 1, Work Wellness Lifefulllnes Health - Fase: quimioterapia',
                'url_audio' => '/assets/client/work_wellness_health/audio/2. SALAS DE QUIMIO STEPH MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 36,
            ],
            [
                'id' => 303, 'number' => 2, 'name' => 'Salas de Quimioterapia 2', 'price' => 0, 'duration' => '1098',
                'description' => 'Nombre: Salas de Quimioterapia 2, Work Wellness Lifefulllnes Health - Fase: quimioterapia',
                'url_audio' => '/assets/client/work_wellness_health/audio/3. SALAS DE QUIMIO JJ MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 36,
            ],
            [
                'id' => 304, 'number' => 3, 'name' => 'Seguimiento en casa 1', 'price' => 0, 'duration' => '979',
                'description' => 'Nombre: Seguimiento en casa 1, Work Wellness Lifefulllnes Health - Fase: quimioterapia',
                'url_audio' => '/assets/client/work_wellness_health/audio/4. SEGUIMIENTO EN CASA JJ MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 36,
            ],
            [
                'id' => 305, 'number' => 4, 'name' => 'Seguimiento en casa 2', 'price' => 0, 'duration' => '915',
                'description' => 'Nombre: Seguimiento en casa 2, Work Wellness Lifefulllnes Health - Fase: quimioterapia',
                'url_audio' => '/assets/client/work_wellness_health/audio/5. SEGUIMIENTO EN CASA STEPH MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 36,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_forgive()
    {
        DB::table('audios')->insert([
            [
                'id' => 306, 'number' => 1, 'name' => 'Me perdono', 'price' => 0, 'duration' => '1643',
                'description' => 'Nombre: Me perdono, Work Wellness Lifefulllnes Health - Fase: perdon',
                'url_audio' => '/assets/client/work_wellness_health/audio/6. ME PERDONO STEPH MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 37,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_acceptance()
    {
        DB::table('audios')->insert([
            [
                'id' => 307, 'number' => 1, 'name' => 'Aceptacion radical', 'price' => 0, 'duration' => '1252',
                'description' => 'Nombre: Aceptacion radical, Work Wellness Lifefulllnes Health - Fase: aceptacion',
                'url_audio' => '/assets/client/work_wellness_health/audio/7. ACEPTACION RADICAL DEL SUCEDER MELINA MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 38,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_heal_my_mind()
    {
        DB::table('audios')->insert([
            [
                'id' => 308, 'number' => 1, 'name' => 'Acepto mis pensamientos', 'price' => 0, 'duration' => '1664',
                'description' => 'Nombre: Acepto mis pensamientos, Work Wellness Lifefulllnes Health - Fase: sanar mi mente',
                'url_audio' => '/assets/client/work_wellness_health/audio/8. ACEPTO MIS PENSAMIENTOS JJ MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 39,
            ],
            [
                'id' => 309, 'number' => 2, 'name' => 'La dimensión mental', 'price' => 0, 'duration' => '920',
                'description' => 'Nombre: La dimensión mental, Work Wellness Lifefulllnes Health - Fase: sanar mi mente',
                'url_audio' => '/assets/client/work_wellness_health/audio/9. LA DIMENSION MENTAL SOFI MASTER B FINAL.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 39,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_heal_my_emotions()
    {
        DB::table('audios')->insert([
            [
                'id' => 310, 'number' => 1, 'name' => 'Dejar ir', 'price' => 0, 'duration' => '922',
                'description' => 'Nombre: Dejar ir, Work Wellness Lifefulllnes Health - Fase: sanar mis emociones',
                'url_audio' => '/assets/client/work_wellness_health/audio/10. DEJAR IR SOFI MASTER B FINAL.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 40,
            ],
            [
                'id' => 311, 'number' => 2, 'name' => 'Conectando con mis emociones', 'price' => 0, 'duration' => '1136',
                'description' => 'Nombre: Conectando con mis emociones, Work Wellness Lifefulllnes Health - Fase: sanar mis emociones',
                'url_audio' => '/assets/client/work_wellness_health/audio/11. CONECTANDO CON MIS EMOCIONES JJ MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 40,
            ],
            [
                'id' => 312, 'number' => 3, 'name' => 'No soy un fracaso', 'price' => 0, 'duration' => '1134',
                'description' => 'Nombre: No soy un fracaso, Work Wellness Lifefulllnes Health - Fase: sanar mis emociones',
                'url_audio' => '/assets/client/work_wellness_health/audio/12. NO SOY UN FRACASO JJ MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 40,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_resilience()
    {
        DB::table('audios')->insert([
            [
                'id' => 313, 'number' => 1, 'name' => 'Reconciliación', 'price' => 0, 'duration' => '964',
                'description' => 'Nombre: Reconciliación, Work Wellness Lifefulllnes Health - Fase: resiliencia',
                'url_audio' => '/assets/client/work_wellness_health/audio/13. RECONCILIACION PAULINA MASTER B.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 41,
            ],
            [
                'id' => 314, 'number' => 2, 'name' => 'STOP construyendo resiliencia', 'price' => 0, 'duration' => '1792',
                'description' => 'Nombre: STOP construyendo resiliencia, Work Wellness Lifefulllnes Health - Fase: resiliencia',
                'url_audio' => '/assets/client/work_wellness_health/audio/14. CONSTRUYENDO LA RESILIENCIA SOFI MASTER B FINAL.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 41,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_heal_my_body()
    {
        DB::table('audios')->insert([
            [
                'id' => 315, 'number' => 1, 'name' => 'Nutrir mi cuerpo', 'price' => 0, 'duration' => '1422',
                'description' => 'Nombre: Nutrir mi cuerpo, Work Wellness Lifefulllnes Health - Fase: sanar mi cuerpo',
                'url_audio' => '/assets/client/work_wellness_health/audio/15. NUTRIR MI CUERPO STEPH MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 42,
            ],
        ]);
    }
    public function work_wellness_lifefullness_health_gratitude()
    {
        DB::table('audios')->insert([
            [
                'id' => 316, 'number' => 1, 'name' => 'Cultivando la gratitud', 'price' => 0, 'duration' => '924',
                'description' => 'Nombre: Cultivando la gratitud, Work Wellness Lifefulllnes Health - Fase:  agradecimiento',
                'url_audio' => '/assets/client/work_wellness_health/audio/16. CULTIVAR LA GRATITUD MELINA MASTER.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 43,
            ],
            [
                'id' => 317, 'number' => 2, 'name' => 'Por la salud que si tengo', 'price' => 0, 'duration' => '925',
                'description' => 'Nombre: Por la salud que si tengo, Work Wellness Lifefulllnes Health - Fase:  agradecimiento',
                'url_audio' => '/assets/client/work_wellness_health/audio/17. POR LA SALUD QUE SI TENGO PAULINA MASTER B.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/lifefullness_high/phase_1/image/Portada_Respira_lento_y_suave_F1.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 43,
            ],
        ]);
    }
    public function meditations_guided_21_mantras()
    {
        DB::table('audios')->insert([
            [
                'id' => 318, 'number' => 1, 'name' => 'Día 1 OM MANI PADME HUM', 'price' => 0, 'duration' => '579',
                'description' => 'Nombre: Día 1 OM MANI PADME HUM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_1.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 319, 'number' => 2, 'name' => 'Día 2 OM NAMAH SHIVAIA', 'price' => 0, 'duration' => '935',
                'description' => 'Nombre: Día 2 OM NAMAH SHIVAIA, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_2.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 320, 'number' => 3, 'name' => 'Día 3 OM SHANTI OM', 'price' => 0, 'duration' => '1314',
                'description' => 'Nombre: Día 3 OM SHANTI OM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_3.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 321, 'number' => 4, 'name' => 'Día 4 OM K´A SHÍ', 'price' => 0, 'duration' => '376',
                'description' => 'Nombre: Día 4 OM K´A SHÍ, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_4.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 322, 'number' => 5, 'name' => 'Día 5 SO HAM', 'price' => 0, 'duration' => '631',
                'description' => 'Nombre: Día 5 SO HAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_5.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 323, 'number' => 6, 'name' => 'Día 6 SAT NAM', 'price' => 0, 'duration' => '1200',
                'description' => 'Nombre: Día 6 SAT NAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_6.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 324, 'number' => 7, 'name' => 'Día 7 OM AH HUM', 'price' => 0, 'duration' => '359',
                'description' => 'Nombre: Día 7 OM AH HUM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_7.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 325, 'number' => 8, 'name' => 'Día 8 OM TATE TUTARE TURA', 'price' => 0, 'duration' => '723',
                'description' => 'Nombre: Día 8 OM TATE TUTARE TURA, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_8.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 326, 'number' => 9, 'name' => 'Día 9 OM', 'price' => 0, 'duration' => '838',
                'description' => 'Nombre: Día 9 OM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_9.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 327, 'number' => 10, 'name' => 'Día 10 HAM', 'price' => 0, 'duration' => '669',
                'description' => 'Nombre: Día 10 HAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_10.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 328, 'number' => 11, 'name' => 'Día 11 YAM', 'price' => 0, 'duration' => '900',
                'description' => 'Nombre: Día 11 YAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_11.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 329, 'number' => 12, 'name' => 'Día 12 RAM', 'price' => 0, 'duration' => '908',
                'description' => 'Nombre: Día 12 RAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_12.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 330, 'number' => 13, 'name' => 'Día 13 VAM', 'price' => 0, 'duration' => '838',
                'description' => 'Nombre: Día 13 VAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_13.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 331, 'number' => 14, 'name' => 'Día 14 LAM', 'price' => 0, 'duration' => '955',
                'description' => 'Nombre: Día 14 LAM, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_14.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 332, 'number' => 15, 'name' => 'Día 15 ONG NAMO', 'price' => 0, 'duration' => '867',
                'description' => 'Nombre: Día 15 ONG NAMO, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_15.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 333, 'number' => 16, 'name' => 'Día 16 OM TAT SAT', 'price' => 0, 'duration' => '826',
                'description' => 'Nombre: Día 16 OM TAT SAT, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_16.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 334, 'number' => 17, 'name' => 'Día 17 OM SHANTI SHANTI', 'price' => 0, 'duration' => '674',
                'description' => 'Nombre: Día 17 OM SHANTI SHANTI, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_17.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 335, 'number' => 18, 'name' => 'Día 18  HARI OM TAT SAT', 'price' => 0, 'duration' => '911',
                'description' => 'Nombre: Día 18  HARI OM TAT SAT, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_18.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 336, 'number' => 19, 'name' => 'Día 19  SAT CHIT ANANDA', 'price' => 0, 'duration' => '935',
                'description' => 'Nombre: Día 19  SAT CHIT ANANDA, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_19.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 337, 'number' => 20, 'name' => 'Día 20  ANANDA', 'price' => 0, 'duration' => '910',
                'description' => 'Nombre: Día 20  ANANDA, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_20.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
            [
                'id' => 338, 'number' => 21, 'name' => 'Día 21 ARDAS BHAEE', 'price' => 0, 'duration' => '641',
                'description' => 'Nombre: Día 21 ARDAS BHAEE, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_mantras/audio/M_21.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 33,
            ],
        ]);
    }
    public function meditations_guided_gratitude()
    {
        DB::table('audios')->insert([
            [
                'id' => 339, 'number' => 1, 'name' => 'Día 1 Cultivar la gratitud', 'price' => 0, 'duration' => '719',
                'description' => 'Nombre: Día 1 Cultivar la gratitud, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_1_Cultivar_la_Gratitud.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 340, 'number' => 2, 'name' => 'Día 2 Gracias porque estoy vivo', 'price' => 0, 'duration' => '656',
                'description' => 'Nombre: Día 2 Gracias porque estoy vivo, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Día_2_Grx_porq_estoy_vivo.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 341, 'number' => 3, 'name' => 'Día 3 Agradesco mis sentidos', 'price' => 0, 'duration' => '939',
                'description' => 'Nombre: Día 3 Agradesco mis sentidos, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Día_3_Agradesco_mis_sentidos.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 342, 'number' => 4, 'name' => 'Día 4 Gracias por mis pensamientos', 'price' => 0, 'duration' => '584',
                'description' => 'Nombre: Día 4 Gracias por mis pensamientos, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_4_Grx_por_mis_pensamientos.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 343, 'number' => 5, 'name' => 'Día 5 Agradesco quien soy', 'price' => 0, 'duration' => '636',
                'description' => 'Nombre: Día 5 Agradesco quien soy, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_5_Agradesco_quien_soy.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 344, 'number' => 6, 'name' => 'Día 6 Gracias por mis dones y talentos', 'price' => 0, 'duration' => '893',
                'description' => 'Nombre: Día 6 Gracias por mis dones y talentos, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_6_Dones_y_talentos_ok.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 345, 'number' => 7, 'name' => 'Día 7 Agradesco mi familia', 'price' => 0, 'duration' => '767',
                'description' => 'Nombre: Día 7 Agradesco mi familia, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_7_Gracias_por_mi_familia.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 346, 'number' => 8, 'name' => 'Día 8 Gracias por mi salud', 'price' => 0, 'duration' => '480',
                'description' => 'Nombre: Día 8 Gracias por mi salud, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_8_Gracias_por_mi_salud.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 347, 'number' => 9, 'name' => 'Dia 9 Gracias por las personas que facilitan mi vida', 'price' => 0, 'duration' => '894',
                'description' => 'Nombre: Dia 9 Gracias por las personas que facilitan mi vida, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_9_Gracias_por_las_personas_que_facilitan_mi_vida.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 348, 'number' => 10, 'name' => 'Dia 10 Agradesco mis amigos', 'price' => 0, 'duration' => '745',
                'description' => 'Nombre: Dia 10 Agradesco mis amigos, Meditaciones Guiadas - Programa 21 días de mantras',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_10_Agradesco_mis_amigos.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 349, 'number' => 11, 'name' => 'Dia 11 Agradesco los lugares que he conocido y conoceré', 'price' => 0, 'duration' => '730',
                'description' => 'Nombre: Dia 11 Agradesco los lugares que he conocido y conoceré, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_11_Agradesco_los_lgares.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
            [
                'id' => 350, 'number' => 12, 'name' => 'Dia 12 Gracias por las celebraciones y momentos maravillosos', 'price' => 0, 'duration' => '804',
                'description' => 'Nombre: Dia 12 Gracias por las celebraciones y momentos maravillosos, Meditaciones Guiadas - Programa de gratitud',
                'url_audio' => '/assets/client/meditations_guided/phase_gratitude/audio/Dia_12_Celebraciones_y_Momentos_Maravillosos.mp3',
                'url_download' => null,
                'url_gif' => '/assets/client/gif/Compress_Loop_1.gif',
                'url_image' => '/assets/client/meditations_guided/phase_breathing/image/Portada_Day_1_F21Breathing.png',
                'restriction_id' => Restriction::WITH,
                'phase_id' => 31,
            ],
        ]);
    }

}
