<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class LegalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->TermsConditions();
        $this->PrivacyPolicies();
    }

    public function TermsConditions()
    {
        DB::table('settings')->insert([
            ['id' => 2, 'name' => 'Términos y condiciones', 'content' => '<p style="text-align: center;"><strong>Terminos y Condiciones MEDITA MEXICO</strong>&nbsp;</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><span style="background: white;">1. Identificación</span></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span style="background: white;">‍Los presentes Términos y Condiciones son aplicables a la
        aplicación Medita México y página web www.meditamexico.org, la cual es operada
        y es Titular la entidad legal FUNDACIÓN MEDITA MEXICO, A.C. (en adelante,
        “FMM”) con domicilio en Periférico Sur 3325, Piso 3, Colonia San Jerónimo
        Lídice, Alcaldía Magdalena Contreras, C.P. 10200, Ciudad de México y correo
        electrónico de contacto: contacto@meditamexico.org.</span></p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span style="background: white;"><br></span></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><span style="background: white;">2. Objeto.</span></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><span style="background: white;">Los presentes Términos y Condiciones establecen las
        condiciones generales de uso y contratación que regularán el acceso y la
        utilización de la aplicación Medita México y página web www.meditamexico.org
        (en adelante, indistintamente, la “App” o la “Plataforma”), incluyendo los
        contenidos y los servicios puestos a disposición de los usuarios (en adelante,
        el “Usuario” o, cuando corresponda los “Usuarios”) a través de la Plataforma.
        No obstante, el acceso y la utilización de ciertos contenidos y/o servicios
        puede encontrarse sometido a determinadas condiciones específicas.</span></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Cualquier cuestión que no hubiera
    sido expresamente prevista en los presentes Términos y Condiciones se entenderá
    reservada a FMM, sin perjuicio de la aplicación de lo dispuesto en la normativa
    vigente.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Asimismo, FMM se reserva el
    derecho a llevar a cabo modificaciones y/o actualizaciones en los presentes
    Términos y Condiciones, de las que se te informará previamente para su
    aceptación o rechazo en caso de resultar sustanciales. En cualquier caso, se
    considerará que aceptas expresamente dichas modificaciones o actualizaciones si
    sigues utilizando y usando a través de la App.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">El acceso y utilización de la App
    implica que aceptas de manera expresa y sin reservas los Términos y Condiciones
    teniendo la misma validez y eficacia que cualquier contrato celebrado por escrito
    y firmado, por lo que, si no estás de acuerdo con estos Términos y Condiciones,
    te sugerimos que no hagas uso de ella.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>3. Servicios de la Plataforma.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La Plataforma ofrece las
    siguientes funcionalidades:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Puesta a disposición de audios de
    meditación guiada para usuarios registrados en la App mediante diversas
    modalidades y programas incluyendo mas no limitando:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><u>RECOGNITIONS PROGRAM</u></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Programa que te certifica como un
    meditador avanzado. Está sustentado por Synchronicity USA y las enseñanzas de
    Master Charles Canon. Recognitions Program consta de 8 fases, cada una con una
    duración de 6 meses y requiere de finalizar la previa para avanzar a la
    siguiente. En Recognitions Program puedes encontrar 3 audios para meditar,
    manual de uso, afirmaciones y lecciones y un mentor que te acompañará en
    sesiones mensuales de forma virtual.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><u>MEMBRESIA LIFEFULLNESS</u></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Nuestros programas Lifefullness
    están creados específicamente para diferentes segmentos: Education (escuelas en
    todos los niveles escolares), Health (hospitales) y Work and Wellness
    (empresas). Al momento en que una escuela, empresa u hospital adquiere para sus
    miembros una membresía Lifefullness los usuarios pueden gozar de audios de
    meditación guiada bajo el sistema Lifefullness creado específicamente para el segmento.
    La duración de la membresía depende directamente del periodo de contratación
    establecido en el contrato con la escuela, hospital u empresa.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><u>MEDITACIONES GUIADAS GRATUITAS</u></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Todos los usuarios pueden gozar
    de audios de meditación guiada con duraciones de 3 a 30 minutos.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><u>AUDIOS ALTA TECNOLOGÍA EN MEDITACIÓN </u></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Los usuarios pueden adquirir
    diferentes álbumes de Alta Tecnología en Meditación Sycnhronicity. Una vez
    comprados los audios se alojarán en la app y podrán ser reproducidos las veces
    que se deseé. Los audios se dividen en tecnología Alpha y Theta,</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>4. Registro y baja de usuarios.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La descarga de la App, así como
    el acceso y registro, son completamente gratuitos. Los Usuarios podrán
    registrarse accediendo al Sitio Web (www.meditamexico.org) y luego accediendo a
    los enlaces de instalación para cada tienda (Android, iOS), una vez instalada
    la aplicación, los Usuarios deben completar el proceso de registro
    proporcionando su: nombre competo, correo electrónico, edad, sexo; en caso de
    tener un programa Lifefullness seleccionar el programa, nivel e insertár el
    código de acceso; aceptar los términos y condiciones del servicio.</p>



<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Al registrarte será necesario que
    previamente leas y aceptes expresamente el Aviso de Privacidad. Además, deberás
    facilitar a FMM cualesquiera otros datos, reales y veraces, que sean
    solicitados, a través de los formularios habilitados en la aplicación móvil,
    con el fin de que FMM pueda prestar los servicios de forma correcta y, en su
    caso, contactar contigo. Tal y como se indica en las presentes Términos y
    Condiciones, así como en el Aviso de Privacidad, tu cuenta de Usuario es
    personal e intransferible.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En cualquier momento puedes
    solicitar tu baja de la App, bastando para ello que accedas al menú perfil y
    posteriormente dando click al botón “Baja de usuario”. Asimismo, puedes
    solicitarlo mediante comunicación escrita a contacto@meditamexico.org indicando
    tu nombre de Usuario y el servicio concreto del que desees darse de baja.
    También podrás solicitar la baja de la recepción de nuestras notificaciones por
    email a través de esa misma dirección o del enlace indicado a tal fin en todos
    los correos electrónicos que recibe. En el caso de tener una suscripción de
    pago activa, el Usuario tendrá que darse de baja en el mecanismo de
    suscripciones proporcionado por su tienda de aplicaciones (en iOS, Android)</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En cualquier caso, podrás
    solicitar un nuevo registro, pudiendo FMM no admitir dicho registro en los
    casos en los que el Usuario haya contravenido lo dispuesto en las presentes
    Términos y Condiciones, en el Aviso de Privacidad o haya actuado de forma
    contraria a la ley, la moral o el orden público. Asimismo, FMM podrá no admitir
    dicho registro en caso de conflicto o controversia suscitado entre las partes,
    que se encuentre por resolver o que haya finalizado con reconocimiento de dolo
    o culpa del Usuario y/o perjuicio a FMM, a sus colaboradores, o a sus Usuarios,
    clientes o potenciales clientes.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">
    <w:sdt sdttag="goog_rdk_0" id="-1156527536"></w:sdt><strong>5.
        Contratación electrónica.</strong>
</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">De conformidad con lo dispuesto
    en el Código de Comercio, el Código Civil Federal, el Código Federal de
    Procedimientos Civiles y la Ley Federal de Protección al Consumidor y demás
    normatividad aplicable, los contratos celebrados por vía electrónica producirán
    todos los efectos previstos por el ordenamiento jurídico cuando concurran el
    consentimiento y los demás requisitos necesarios para su validez. Para realizar
    cualquier Contratación de nuestros servicios se deberá de contar con la mayoría
    de edad, dependiendo de la jurisdicción de cada país del usuario.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En todo caso, el soporte
    electrónico en que conste el contrato celebrado por vía electrónica será
    admisible como prueba documental en caso de controversia entre las partes. Los
    presentes Términos y Condiciones se encuentran a disposición de todos los
    Usuarios desde el siguiente link de forma libre, gratuita y permanente. Del
    mismo modo, y atendiendo a la normativa aplicable, se pone a disposición de los
    Usuarios, de forma previa al inicio del procedimiento de contratación, toda la
    información relativa al mismo.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">A estos efectos, se entenderá que
    el seguimiento de todas las fases del proceso de compra y, en su caso, el abono
    de la cantidad económica correspondiente, implican necesariamente la prestación
    del consentimiento requerido para la contratación. El acceso al proceso de contratación
    es completamente gratuito, sin que exista ningún coste asociado adicional,
    aparte de los relativos a la disposición de conexión de Internet por parte del
    Usuario.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Todos los contenidos,
    funcionalidades y suscripciones se encuentran perfectamente descritos en sus
    correspondientes descripciones a disposición de los Usuarios, no entendiéndose
    incluidas aquellas cuestiones que expresamente no hubieran sido indicadas en
    las mismas.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>6.Procedimiento de Contratación.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">‍El procedimiento de contratación
    de los contenidos, funcionalidades o suscripciones se lleva a cabo de forma
    electrónica a través de la Plataforma. Cualquier persona con acceso a Internet
    puede llevar a cabo la contratación, siendo de acceso público parte de los
    productos ofrecidos a través de la Plataforma. Para visualizar ciertos
    contenidos y el mero acceso a la Plataforma, serán gratuitos.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">El procedimiento completo que
    deberán seguir todos los Usuarios que desean adquirir alguno de los contenidos,
    funcionalidades o suscripciones es el siguiente:</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 48px; text-align: justify; text-indent: -24px;"><strong><span>A)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;
            </span></span></strong><strong><span style="color: black;">REGISTRO </span>GRATUITO</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></span>Descargar la App y registrar su usuario/cuenta</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></span>Accede a los audios de meditación guiada en el apartado
    “Meditaciones guiadas”</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 48px; text-align: justify; text-indent: -24px;"><span>B)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span><span style="color: black;">MEMBRESIA </span>LIFEFULLNESS (para escuelas, hospitales y
    empresas)</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Descargar
    la App </p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Elige
    el campo “Tengo un programa” y<span>&nbsp; </span>registrar
    su usuario utilizando el código proporcionado por tu empresa/hospital/ escuela</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>3.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Accede
    a los audios de meditación guiada en el apartado “Meditaciones guiadas” y a las
    meditaciones guiadas de Lifefullness en el apartado “Lifefullness”</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 48px; text-align: justify; text-indent: -24px;"><span>C)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span>COMPRA
    AUDIOS</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Accede
    a la App con usuario gratuito</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Elige
    el audio de ATM que deseas descargar. Puedes escuchar hasta 1 min de cada audio
    para conocer la pista. </p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>3.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Agrégalo
    al carrito si deseas continuar comprando o elige “pagar” para ir directo al
    pago</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>4.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Agrega
    un método de pago</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>5.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></span>En caso de no tener la tarjeta de crédito registrada en
    el dispositivo, es posible que sea necesario introducirla en la plataforma de
    Apple, Google Pay o Amazon Pay.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>6.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></span>Disfruta de tu audio ATM</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 48px; text-align: justify; text-indent: -24px;"><span>D)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span>COMPRA
    RECOGNITIONS PROGRAM</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Accede
    a la App con usuario gratuito</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Elige
    la fase de Recognitions Program que deseas adquirir.</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>3.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Agrégalo
    al carrito si deseas continuar comprando o elige “pagar” para ir directo al
    pago</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>4.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Agrega
    un método de pago</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>5.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>En
    caso de no tener la tarjeta de crédito registrada en el dispositivo, es posible
    que sea necesario introducirla en la plataforma de Apple, Google Pay o Amazon
    Pay.</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>6.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Disfruta
    de todo el contenido RP</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>7.Precios.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Los precios aparecerán en peso
    mexicano como moneda principal, aunque en caso de otros países puede mostrarse
    en dólares u otra moneda, pudiendo existir modificaciones en el precio con
    motivo del cambio de divisa. En todo caso siempre se mostrará en pantalla la
    moneda El precio de los contenidos, funcionalidades y las suscripciones se
    mostrarán en la Plataforma. Los precios pueden cambiar a lo largo del tiempo,
    pero estos cambios no afectarán a ninguna compra de contenidos, funcionalidades
    o suscripciones realizada por el Usuario y confirmada por FMM de forma previa y
    conforme a la vigencia de cada suscripción. El precio total especificado en el
    proceso final de adquisición de un contenido o de la suscripción incluye
    impuestos. Sin perjuicio de lo anterior, FMM informa al Usuario de que, en caso
    de error manifiesto en el precio de un contenido, funcionalidad o suscripción,
    FMM podrá cancelar su compra siempre que no la haya confirmado.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Una vez el Usuario ha realizado
    un pedido y abonado el pago correspondiente a través de cualquiera de las
    formas de pago puestas a disposición de los Usuarios por FMM, ésta remitirá al
    Usuario un correo electrónico en el que se recogerá toda la información
    relativa a los contenidos, funcionalidades o suscripciones adquiridos, su
    precio unitario, los impuestos aplicables, así como el precio total de la
    compra.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">El Usuario queda informado que el
    abono de las cantidades económicas pertinentes para la adquisición de
    contenidos, suscripciones y funcionalidades se llevará a cabo a través de una
    plataforma provista por una entidad externa, que en todo caso se encontrará
    alojada bajo el protocolo seguro SSL.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En cualquier caso, la
    contratación sólo será efectiva cuando FMM reciba confirmación del pago por la
    entidad propietaria de la pasarela de pago seguro. Si la transacción resultase
    por algún motivo rechazada por dicha entidad, la compra se suspenderá
    informando al Usuario de esta circunstancia.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En ningún momento del
    procedimiento de compra FMM conocerá la información relativa a los datos de
    pago, que son digitalizadas directamente en la pasarela de pago (con sistemas de
    seguridad que evitan la interceptación, modificación o falsificación de la
    información). Ningún archivo informático de FMM contiene, ni conserva, tales
    datos. En ningún caso FMM puede ser, por lo tanto, considerado responsable por
    un eventual uso fraudulento e indebido de estos datos de pago por parte de
    terceros.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Solamente podrá disfrutarse de un
    periodo gratuito una vez por cuenta registrada.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong><span style="background: white;">7.1 Donativos</span></strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Todas las compras se manejan como
    donativos los cuales se destinan y tienen como finalidad el llevar programas de
    bienestar a escuelas, hospitales y comunidades de bajos recursos en México.
    Existen varias formas de apoyar a la causa, ya sea realizando compras y/o
    donativos directos conforme a lo siguiente:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>A)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span>EN
    LA APP</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Todos los
    contenidos adquiridos a través de la app se manejan como donativo por lo que a
    todos los usuarios se les muestra la opción de solicitar factura deducible de
    impuestos, donde el apoyo y soporte es contacto@meditaméxico.org</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>B)<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp; </span></span>EN
    LA PLATAFORMA </p>

<p class="MsoNormal" style="margin: 0px 0px 11px 48px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">3 Formas de
    hacer un donativo en la plataforma:</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>1.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>En
    la página web se encuentra un botón “Haz un donativo” el cual al dar clic
    redirige al carrito donde el usuario puede elegir el monto a donar y si es de
    forma recurrente y posteriormente agregar los datos bancarios.</p>

<p class="MsoNormal" style="line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; margin: 0px 0px 0px 96px; text-align: justify; text-indent: -24px;"><span>2.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></span>Adquirir
    audios ATM o artículos de mercancía, de igual manera a todos los usuarios se
    les muestra la opción de solicitar factura deducible de impuestos, donde el
    apoyo y soporte es contacto@meditaméxico.org</p>

<p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><span>3.<span style="font: 9px &quot;Times New Roman&quot;;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </span></span>En el carrito donde se procede al pago de ATM o
    artículos, antes de proceder al pago aparece una opción de agregar un monto por
    donativo.</p><p class="MsoNormal" style="margin: 0px 0px 11px 96px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify; text-indent: -24px;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>‍8. Propiedad intelectual, industrial y derechos de imagen.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FMM es titular o, en su caso,
    cuenta con las licencias correspondientes sobre los derechos de propiedad
    intelectual, industrial, de imagen o cualesquiera otros análogos sobre la
    Plataforma, así como de todos los contenidos ofrecidos en el mismo, incluyendo,
    a título enunciativo, pero no limitativo a audios, videos, fotografías,
    ilustraciones, logos, marcas, diseños, interfaces, o cualquier otra información
    o contenido incluidos en el mismo.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">ÚNICAMENTE DISPONES DE DERECHO DE
    USO NO EXCLUSIVO, DENTRO DE UN ÁMBITO ESTRICTAMENTE DOMÉSTICO Y ÚNICAMENTE CON
    LA FINALIDAD DE PODER HACER USO DE LA PLATAFORMA. CUALQUIER USO NO AUTORIZADO
    POR CUALQUIER USUARIO, SERÁ MOTIVO PARA DAR DE BAJA LOS USUARIOS Y EN SU CASO
    FMM SE RESERVA LAS ACCIONES LEGALES QUE CORRESPONDAN.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Por otro lado, el Usuario al
    utilizar, publicar o incluir en su perfil contenidos concede en favor de FMM
    una licencia no exclusiva, por el máximo periodo permitido por la legislación
    aplicable y con carácter mundial, los derechos de reproducción, distribución,
    comunicación pública (incluida la puesta a disposición) y transformación, sobre
    los contenidos.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>9. Atención al Usuario.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Tienes a tu disposición el
    servicio de atención al usuario por el que FMM atenderá las consultas, quejas y
    sugerencias planteadas por los Usuarios.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Podrás acceder al servicio de
    atención al cliente a través del siguiente e-mail de contacto:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">E-mail: contacto@meditamexico.org</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Daremos respuesta a tus
    reclamaciones o consultas en el plazo más breve posible y, en cualquier caso,
    en un plazo máximo de un 1 mes contado a partir de la recepción del correo
    electrónico.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>10. Enlaces.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En el caso de que en la
    Plataforma se mostrasen enlaces a páginas web mediante diferentes botones,
    links, banners, etc., FMM te informa de que éstos están directamente
    gestionados por terceros, no pudiendo controlar o aprobar toda la información
    contenida en otras plataformas a las que se puedan establecer enlaces desde la
    Plataforma. Consecuentemente, FMM no asumirá ninguna responsabilidad por
    cualquier aspecto relacionado con alguna de estas plataformas o páginas web.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En cualquier caso, estos enlaces
    no implicarán que exista algún tipo de relación, colaboración o dependencia
    entre FMM y el responsable de la aplicación o página web ajena. En este
    sentido, si tuvieras conocimiento de que las actividades desarrolladas a través
    de estas páginas web de terceros son ilegales o contravienen la moral y/o el orden
    público, deberás comunicarlo inmediatamente a FMM para que pueda proceder a
    deshabilitar el enlace a las mismas.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>11. Responsabilidades de FMM.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FMM se obliga a que los
    contenidos, datos o informaciones relativos a los Servicios ofrecidos a través
    de la Plataforma sean fiables, veraces y exactos. No obstante, no se hará
    responsable de aquellas informaciones que hubieran sido introducidas, mostradas
    o modificadas por terceros ajenos a FMM. Así pues, la Plataforma excluye
    cualquier responsabilidad por los daños y perjuicios que puedan deberse a la
    información y/o servicios prestados o suministrados por terceros diferentes de
    la Plataforma.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Asimismo, FMM declara que ha
    adoptado todas las medidas necesarias, dentro de sus posibilidades y del estado
    de la técnica, para garantizar el funcionamiento de la Plataforma y reducir al
    mínimo los errores del sistema, tanto desde el punto de vista técnico como de
    los contenidos publicados en la Plataforma.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Sin embargo, FMM no será
    responsable en caso de indisponibilidad de la Plataforma o de la imposibilidad
    de contratar los servicios cuando ello sea por circunstancias ajenas a FMM,
    fuerza mayor o error en el proceso de contratación o datos facilitados por el
    Usuario. Sin embargo, en dichos casos, FMM se pondrá en contacto contigo a fin
    de encontrar la mejor solución al caso.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FMM empleará todos los esfuerzos
    comercial y técnicamente a su alcance para mantener disponibles los servicios
    ofrecidos a través de la Plataforma, lo que constituye una obligación que, no
    obstante, no será de aplicación a cualquier falta de disponibilidad o de
    rendimiento provocada por:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Inactividad temporal de la
    Plataforma debido a actualización y/o mantenimiento técnico, de lo que se
    informará previamente mediante publicación en la propia Plataforma en un plazo
    máximo de 48 horas, siempre que estas circunstancias sean conocidas o
    comunicadas a FMM con un plazo de antelación superior al indicado;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Causas ajenas al control de FMM:
    fuerza mayor, problemas de acceso a Internet, problemas tecnológicos más allá
    de la gestión diligente y razonable del titular de la Plataforma, acciones u
    omisiones de terceros, etc.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En todos los casos referidos,
    ajenos al control y la diligencia debida por FMM, no habrá lugar a
    indemnización de ésta al Usuario por lucro cesante, daños o perjuicios.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En caso de cierre o suspensión de
    la Plataforma por causas ajenas a la actuación de las partes, se te informará
    puntualmente del traslado del servicio a un nuevo dominio, modificándose
    únicamente las estipulaciones del presente contrato en lo relativo al dominio
    en que la Plataforma permanece activa.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FMM no se encuentra dirigida,
    diseñada o en modo alguno orientada a diagnosticar o tratar ningún tipo de
    condición física o enfermedad, así como tampoco a declarar el estado de su
    salud o para ser sustituto de tratamiento médico profesional. En el caso de que
    padezca alguna patología o enfermedad, FMM recomienda que acuda a un
    profesional sanitario.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>12. Suspensión de la plataforma.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FMM podrá suspender, modificar,
    restringir o interrumpir en cualquier momento el acceso a la Plataforma, con o
    sin previa notificación a quienes contravengan las Condiciones de Uso, sin
    posibilidad de exigir indemnización.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>13. Reglas de uso.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">No está permitido el acceso o la
    utilización de la Plataforma con fines ilegales o no autorizados, con o sin
    finalidad económica, por lo que serás el único responsable. En particular, y
    sin que el siguiente listado tenga carácter absoluto ni limitativo, queda
    prohibido:</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma en forma
    alguna que pueda provocar daños, interrupciones, ineficiencias o defectos en su
    funcionamiento o en el ordenador de un tercero.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma para la
    transmisión, instalación o publicación de cualquier virus, troyano, gusano,
    bomba lógica, código malicioso u otros programas o archivos perjudiciales.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma para
    transmitir material con fines publicitarios o de promoción, incluidos spam,
    correos electrónicos en cadena o similares.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">‍Usar la Plataforma de manera que
    constituya una vulneración de los derechos de FMM o de cualquier tercero.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma para
    transmitir o publicar cualquier material de carácter difamatorio, ofensivo,
    racista, denigrante, amenazadora o que pueda causar molestia a cualquier otro
    Usuario.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma para recoger
    datos de carácter personal de otros Usuarios.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Usar la Plataforma de forma
    ilegal, en contra de la buena fe, la moral y/o el orden público.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Acceder o registrarse a través de
    la Plataforma con una identidad falsa, suplantando a terceros o utilizando un
    perfil o realizando cualquier otra acción que pueda confundir a otros Usuarios
    sobre la identidad del origen de un mensaje.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Acceder sin autorización a
    cualquier sección de la Plataforma, a otros sistemas o redes conectados a la
    misma, a cualquier servidor de FMM, o a los servicios ofrecidos a través de la
    Plataforma, por medio de pirateo o falsificación, extracción de contraseñas o
    cualquier otro medio ilegítimo.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Quebrantar, o intentar
    quebrantar, las medidas de seguridad o autenticación de la Plataforma o de
    cualquier red conectada a ésta, o las medidas de seguridad o protección
    inherentes a los contenidos ofrecidos en la Plataforma.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Llevar a cabo alguna acción que
    provoque una saturación desproporcionada o innecesaria en la infraestructura de
    la Plataforma o en los sistemas o redes de FMM, así como en los sistemas y
    redes conectados a la Plataforma.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Impedir el normal desarrollo de
    un evento, promoción o cualquier otra actividad disponible a través de la
    Plataforma o cualesquiera de sus funcionalidades, ya sea alterando o tratando
    de alterar, ilegalmente o de cualquier otra forma, el acceso, participación o
    funcionamiento de aquéllos, o falseando el resultado de los mismos y/o
    utilizando métodos de participación fraudulentos, mediante cualquier
    procedimiento, y/o a través de cualquier práctica que atente o vulnere en modo
    alguno las presentes Condiciones generales de Uso.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">El incumplimiento de cualquiera
    de las anteriores obligaciones por tu parte podrá llevar aparejada la adopción
    por FMM de las medidas oportunas amparadas en Derecho y en el ejercicio de sus
    derechos u obligaciones, pudiendo llegar a la eliminación o bloqueo de la
    cuenta del Usuario infractor, sin que medie posibilidad de indemnización alguna
    por los daños y perjuicios causados.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>14. Responsabilidad del usuario.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Asimismo, deberás respetar en
    todo momento los términos y condiciones establecidos en las presentes
    condiciones de Uso. De forma expresa manifiestas que utilizarás el portal de
    forma diligente y asumiendo cualquier responsabilidad que pudiera derivarse del
    incumplimiento de las normas. Asimismo, no estará permitida la utilización de
    la Plataforma con fines ilegales o no autorizados, con o sin finalidad
    económica. Tanto los servicios ofrecidos, como la información contenida en la
    Plataforma, no podrán ser utilizados con fines comerciales o publicitarios sin
    la previa autorización de FMM.</p>



<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">‍Además, serás responsable de
    cualquier comunicación que facilites a FMM. Esta responsabilidad abarca la
    exactitud, legalidad, originalidad y titularidad de tal comunicación, debiendo
    mantener indemne a FMM. Si tuvieras conocimiento de la existencia de algún
    contenido ilícito, ilegal, contrario a las leyes o que pudiera suponer una
    infracción de derechos de terceros, deberás notificarlo inmediatamente a FMM
    para que ésta pueda proceder a la adopción de las medidas oportunas.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En caso de que llevases a cabo
    alguna actuación susceptible de ser considerada como ilícita, ilegal, contraria
    a las leyes o que pudiese suponer la infracción o vulneración de derechos de
    terceros, lo harás bajo tu entera responsabilidad, manteniendo indemne a FMM
    por tus actuaciones.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>15. Dispositivos y sistemas.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Para poder hacer uso de la
    Plataforma, el Usuario debe contar con la conexión a Internet y los
    dispositivos y equipos que sean necesarios.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La Plataforma requiere acceso a
    Internet, siendo el Usuario responsable de todos los gastos asociados a dicha
    conexión, incluidos aquellos gastos derivados del tráfico de datos,
    independientemente del lugar en el que el Usuario haga uso de la Plataforma.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La versión actual de la APP
    Medita México está disponible para los sistemas operativos IOS y ANDROID. Cada
    una de las plataformas en los sistemas operativos describe los requisitos
    operativos y de sistema para poder descargar la APP.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>16. Interpretación</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Todas las cláusulas o extremos
    del presente contrato deben ser interpretadas de forma independiente y
    autónoma, no viéndose afectadas el resto de estipulaciones en caso de que una
    de ellas haya sido declarada nula por sentencia judicial o resolución arbitral
    firme. Se sustituirá la cláusula o cláusulas afectadas por otra u otras que
    preserven los efectos perseguidos por las Condiciones de Uso de la Plataforma.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><strong>17. Resolución de controversias.</strong></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Para toda cuestión litigiosa
    relacionada con esta Plataforma o cualquiera de los que de él dependa, y
    siempre que la legislación así lo permita, será de aplicación la legislación
    mexicana vigente en el momento de la controversia, siendo competentes para la
    resolución de todos los conflictos derivados o relacionados con el uso de la Plataforma
    los Juzgados y Tribunales de la Ciudad de México, México.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En todo caso, para presentar
    reclamaciones en el uso de nuestros servicios, puedes dirigirte por correo a la
    dirección electrónica o física indicada en el apartado “Identificación”, comprometiéndonos
    a buscar en todo momento una solución amistosa del conflicto.</p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><br></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Fecha de última actualización: Marzo
    2023.</p>'],
        ]);
    }

    public function PrivacyPolicies()
    {
        DB::table('settings')->insert([
            [
                'id' => 3, 'name' => 'Políticas de privacidad', 'content' => '<p dir="ltr" style="line-height:1.2;text-align: center;margin-top:0pt;margin-bottom:0pt;"><strong>Aviso de Privacidad&nbsp;FUNDACION MEDITA MÉXICO 2023</strong></p><p dir="ltr" style="line-height:1.2;text-align: center;margin-top:0pt;margin-bottom:0pt;"><strong style="font-weight:normal;" id="docs-internal-guid-58b9d9ba-7fff-ab88-b9a0-f653a60914fb"><span style="font-size: 13.6661pt; font-family: Arial; color: rgb(0, 0, 0); background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"><br></span></strong></p><p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">En FUNDACION MEDITA MÉXICO, A.C.
    reconocemos el valor de la privacidad, así como el derecho del titular de la
    información personal o de datos personales a su estricta y respetuosa
    utilización. El presente Aviso de Privacidad tiene como objeto informarte que
    información podemos obtener en la utilización de la aplicación Medita México
    así como la manera en la que se obtiene la misma, se usa, se divulga, se
    almacena o, en general, se da tratamiento a tus datos personales, que se
    proporcionan a FUNDACION MEDITA MÉXICO, A.C.<span>&nbsp;
    </span>por cualquier medio.</p>

<p style="font-size: 16px; font-family: &quot;Times New Roman&quot;, serif; margin: 0px 0px 11px; text-align: justify;"><span style="font-size: 15px; font-family: Calibri, sans-serif; background: white;">‍El presente Aviso de Privacidad es aplicables para cualquier
        usuario de la aplicación Medita México y/o página web </span><a href="http://www.meditamexico.org" style="color: rgb(5, 99, 193); text-decoration: underline;"><span style="font-size: 15px; font-family: Calibri, sans-serif; color: windowtext; background: white;">www.meditamexico.org</span></a><span style="font-size: 15px; font-family: Calibri, sans-serif; background: white;"><span>&nbsp; </span>la cual es operada y es Titular la entidad
        legal FUNDACIÓN MEDITA MEXICO, A.C. (en adelante, “FMM”) con domicilio en
        Periférico Sur 3325, Piso 3, Colonia San Jerónimo Lídice, Alcaldía Magdalena
        Contreras, C.P. 10200, Ciudad de México y correo electrónico de contacto:
        contacto@meditamexico.org.</span></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La información privada que
    recibimos, lo es entre otras formas, por el la descarga de nuestra App Medita
    México , visita a la página web <a href="http://www.meditamexico.org" style="color: rgb(5, 99, 193); text-decoration: underline;"><span style="color: windowtext; background: white;">www.meditamexico.org</span></a><span style="background: white;">, suscripción por correo electrónico,</span> contacto
    directo en nuestras oficinas, en nuestros talleres, programas, sucursales,
    exposiciones, seminarios o capacitaciones con el público consumidor para el
    conocimiento de las actividades, servicios de la asociación o sus empresas
    afiliadas y/o subsidiarias y/o asociados o el contacto que refiere la
    interacción de personas con nuestros sitios o portales de internet.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">De igual forma, recibimos
    información de la participación en actividades de promoción de servicios, así
    como nuestra participación en reuniones en sitios de terceros donde nos hacemos
    sabedores por conducto de su titular de información personal privada por sus
    características, o por terceros que se acercan a nosotros o de terceros ajenos
    a nuestro interés particular como FUNDACION MEDITA MÉXICO, A.C., con solicitudes
    de empleo u ofreciendo o materializando proveeduría de bienes o servicios como
    personas físicas, o tienen contacto de tal naturaleza vía la navegación en
    nuestro portal.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FUNDACION MEDITA MÉXICO,
    A.C.<span>&nbsp; </span>utiliza como parte de su identidad
    comercial las marcas y/o0020avisos comerciales registrados “MEDITA MEXICO A.C.”
    entre otros y el presente Aviso de Privacidad aplica en aquellos medios de
    comunicación ya sean escritos, electrónicos o verbales, por y donde recibimos
    información privada de terceros, por lo que los contactos para el ejercicio del
    titular de la información para su ACLARACION, RECTIFICACION, CANCELACION y
    OPOSICIÓN (derechos ARCO) son los medios identificados en el presente Aviso de
    Privacidad.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Datos Personales que se
        recaban:</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Los Datos Personales que se
    recaban por nuestra sociedad ,navegando por nuestra App y portal; lo pueden
    ser: nombre completo, domicilio, imagen, voz, edad, estado civil, profesión,
    grado de estudios, ocupación, preguntas relacionadas con el giro de negocios, o
    por su naturaleza con el giro o actividad de la persona que contacta, correo
    electrónico, teléfono y otros datos de identificación.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Al registrarte de forma expresa
    enviando o solicitando información, autorizas a FUNDACION MEDITA MÉXICO,
    A.C.<span>&nbsp; </span>a recabar y tratar tus datos
    personales para los fines mencionados en este Aviso de Privacidad. Así mismo,
    tu registro constituye tu conformidad y aceptación de nuestro Aviso de
    Privacidad y las modificaciones que eventualmente pueda llegar a tener.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Finalidades del tratamiento de
        sus Datos Personales.</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Los datos personales que tú
    decides compartir con nosotros a través , por la descarga de nuestra App Medita
    México , visita a la página web <a href="http://www.meditamexico.org" style="color: rgb(5, 99, 193); text-decoration: underline;"><span style="color: windowtext; background: white;">www.meditamexico.org</span></a><span style="background: white;">,</span> suscripción por correo electrónico, contacto
    directo en nuestras oficinas, en nuestros talleres, programas, sucursales,
    exposiciones, seminarios o capacitaciones con el público consumidor para el
    conocimiento de las actividades, servicios de la asociación o sus empresas
    afiliadas y/o subsidiarias y/o asociados o el contacto que refiere la
    interacción de personas con nuestros sitios o portales de internet, serán
    utilizados y tratados de conformidad con el presente Aviso de Privacidad y de
    acuerdo a las disposiciones vigentes en materia de protección de Datos
    Personales y en su caso estrictamente para la finalidad de usarlos en forma
    enunciativa, más no limitativa para: identificarte, ubicarte, comunicarte,
    contactarte, enviarte información, actualizar nuestra base de datos, obtener
    estadísticas, promocionar los servicios, productos, programas, cursos y eventos
    de FUNDACION MEDITA MÉXICO, A.C, así como para actividades de promoción,
    implementar programas, así como en diferentes materiales, con fines de
    comunicación pública, profesionales, promoción, difusión, publicidad,
    mercadotecnia, campañas, publicaciones, videos, procesos de contratación y
    recaudación de fondos.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La temporalidad del manejo de tus
    Datos Personales será indefinida a partir de la fecha en que nos los
    proporciones, pudiendo oponerte al manejo de los mismos en cualquier momento
    que lo consideres oportuno.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Al utilizar nuestra pagina Web ,
    descargar la App ,enviar vía correo electrónico tus datos personales a los
    diferentes representantes de FUNDACION MEDITA MÉXICO, A.C.<span>&nbsp; </span>; y/o cumplimentar cualquiera de las
    solicitudes en línea que aparecen en la página de internet de FUNDACION MEDITA
    MÉXICO, A.C. .; y/o cumplimentar los formatos de seguidores de nuestra entidad
    legal; y/o proporcionar tus datos a través de las diversas hojas de firmas en
    participaciones en ferias, convenciones, seminarios o capacitaciones o
    cualquier evento público relacionado con nuestras actividades; y/o al
    proporcionarlos vía telefónica a los diferentes representantes de FUNDACION
    MEDITA MÉXICO, A.C.<span>&nbsp; </span>aceptas y autorizas
    a FUNDACION MEDITA MÉXICO, A.C.<span>&nbsp; </span>a
    utilizar y tratar de forma automatizada tus datos personales e información
    suministrados, los cuales formarán parte de nuestra base de datos.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Otra Información</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Cuando tu navegas en nuestro
    portal web, se recaba cierta información no personal por medio de “cookies” y
    de los registros del servidor. El propósito de recabar esta información es
    generar estadísticas relativas a las visitas a nuestro portal web y los
    portales de referencia que puedan haberle traído al nuestro. Esta información
    también se utiliza para mantener y actualizar los perfiles de los usuarios en
    nuestro portal web, para personalizar el perfil de un usuario al visitarlo y
    para adecuar la información que se proporciona a través de nuestro portal web.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Cookies</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Una cookie es un identificador
    alfanumérico que se almacena en su disco duro a través de su navegador, cuando
    usted visita nuestro portal web. Las cookies nos permiten mejorar el servicio
    de nuestro portal web y también pueden ser utilizadas para compilar información
    agregada sobre las áreas más visitadas. Esta información del tráfico se utiliza
    para mejorar el contenido de nuestro portal web y facilitar su uso. Si desea
    rechazar el uso de cookies, puede configurar su navegador para hacerlo; sin
    embargo, cabe la posibilidad de que ciertas aplicaciones no sean visualizadas
    correctamente por ese rechazo.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Archivos de registro</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Nuestro portal web utiliza
    ciertos archivos que registran información acerca de la actividad que puede
    ocurrir dentro del mismo; por ejemplo, usuarios del Protocolo de Internet (IP),
    tipo de navegador, proveedor de servicios de Internet (ISP), páginas referidas
    y de entrada, tipo de plataforma, sello de fecha y hora y número de clics. Esta
    información se utiliza para administrar la página y analizar el tráfico de
    nuestro portal web.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Medidas de Seguridad / Límites
        al acceso</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FUNDACION MEDITA MÉXICO, A.C. ha
    adoptado las medidas de seguridad técnicas, administrativas y físicas
    necesarias para procurar la integridad y confidencialidad de sus Datos
    Personales y evitar su daño, pérdida, alteración, destrucción o el uso, acceso
    o tratamiento no autorizados.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Por otra parte, FUNDACION MEDITA
    MÉXICO, A.C.<span>&nbsp; </span>le menciona y confirma que
    únicamente personal autorizado por esta entidad legal y que ha cumplido y
    observado los correspondientes requisitos de confidencialidad, podrá participar
    en el tratamiento de sus Datos Personales.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Transferencias de Datos
        Personales</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">FUNDACION MEDITA MÉXICO, A.C. se
    compromete a no vender, intercambiar, transferir, compartir, publicar o
    difundir a terceros ajenos a FUNDACION MEDITA MÉXICO, A.C. ., sin la
    autorización del titular de los Datos Personales, los datos que proporciones
    mediante los formularios de registro o de contacto de nuestro sitio. La única
    forma en que nos veríamos obligados a revelar tus datos es mediante la orden de
    una autoridad competente.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Enlaces</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Nuestro portal web puede contener
    por considerarlo de interés de sus visitantes o usuarios, enlaces a otros
    portales web. Advirtiendo que FUNDACION MEDITA MÉXICO, A.C. no ha revisado las
    Políticas de Privacidad de dichos portales o sitios web, por lo que no
    garantiza ni se hace responsable del contenido en dichos enlaces. Por ello los
    invitamos a que lea cuidadosamente la Política de Privacidad de cada uno de los
    portales vinculados desde este portal web.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Derechos que le corresponden
        al titular de Datos Personales.</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Como titular de datos personales,
    tu puedes ejercitar ante el encargado de Protección de Datos Personales de la
    Fundación, los derechos de acceso, rectificación, cancelación y oposición
    (derechos “ARCO”). Asimismo, puedes revocar, en todo momento, el consentimiento
    que hayas otorgado y que fuere necesario para el tratamiento de tus datos
    personales, así como limitar el uso o divulgación de los mismos. Toda
    corrección o cancelación solicitada por el titular de los Datos Personales y
    efectuada por FUNDACION MEDITA MÉXICO, A.C.<span>&nbsp;
    </span>será informada por el mismo medio que fue solicitada por titular en un
    plazo de quince días naturales posteriores a su solicitud</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">La solicitud para el ejercicio de
    tus derechos “ARCO” podrá solicitarse por el interesado a través del envío de
    su solicitud escrita, concreta y plenamente identificable como propia del
    titular del derecho, ya sea al domicilio de FUNDACION MEDITA MÉXICO, A.C.<span>&nbsp; </span>ubicado en Av. Periférico Sur, No. 3325, 3er
    piso, Colonia San Jerónimo Lídice, C.P. 10,200, en la Ciudad de México, o al
    correo electrónico contacto@meditamexico.org</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Cambios a la Política de
        Privacidad.</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Nos reservamos el derecho de
    hacer cambios al presente Aviso de Privacidad, por lo que le sugerimos que la
    revise periódicamente a fin de conocer las modificaciones más recientes. El
    Aviso de Privacidad vigente será publicado en nuestro portal web y en el se
    indicará la fecha de su última revisión. El uso de nuestro portal web es prueba
    que has leído, conoces y aceptas el Aviso y Política de Privacidad vigente al
    momento de dicho uso.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>&nbsp;</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Contacto</b></p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">Si tienes alguna pregunta o
    comentario respecto a este Aviso de Privacidad o desea ejercer los derechos que
    por ley le corresponden, le pedimos contacte al Encargado de Protección de
    Datos Personales al correo electrónico: contacto@meditamexico.org o por escrito
    al domicilio ubicado en Av. Periférico Sur, No. 3325, 3er piso, Colonia San
    Jerónimo Lídice, C.P. 10,200, en la Ciudad de México.</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;">&nbsp;</p>

<p class="MsoNormal" style="margin: 0px 0px 11px; line-height: 107%; font-size: 15px; font-family: Calibri, sans-serif; text-align: justify;"><b>Última revisión: marzo 2023</b></p>'
            ]
        ]);
    }
}
