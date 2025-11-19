<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLifefullnessSchema extends Migration
{

    protected const
        ANSWERS = 'answers',
        AUDIOS = 'audios',
        CATEGORIES = 'categories',
        CATEGORY_PROGRAM = 'category_program',
        CLIENTS = 'clients',
        CLIENT_QUESTION = 'client_question',
        EDUCATIONAL_LEVELS = 'educational_levels',
        EMOTIONAL_STATISTICS = 'emotional_statistics',
        EVALUATIONS = 'evaluations',
        GENDERS = 'genders',
        INSTITUTIONS = 'institutions',
        INSTRUCTIONS = 'instructions',
        INSTRUCTIVE = 'instructives',
        MANUALS = 'manuals',
        NEWS = 'news',
        PAYMENTS = 'payments',
        PHASES = 'phases',
        PROGRAMS = 'programs',
        QUESTIONS = 'questions',
        RESTRICTIONS = 'restrictions',
        ROLES = 'roles',
        SETTINGS = 'settings',
        TYPE_CLIENTS = 'type_clients',
        USERS = 'users';

    protected const
        SETTING_ID = 'setting_id',
        ROL_ID = 'role_id',
        TYPE_CLIENT_ID = 'type_client_id',
        PROGRAM_ID = 'program_id',
        INSTRUCTIVE_ID = 'instructive_id',
        MANUAL_ID = 'manual_id',
        CATEGORY_ID = 'category_id',
        RESTRICTION_ID = 'restriction_id',
        PHASE_ID = 'phase_id',
        GENDER_ID = 'gender_id',
        INSTITUTION_ID = 'institution_id',
        AUDIO_ID = 'audios_id',
        EDUCATIONAL_LEVEL_ID = 'educational_level_id',
        QUESTION_ID = 'question_id',
        ANSWER_ID = 'answer_id',
        CLIENT_ID = 'client_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        self::createSettingTable(self::SETTINGS);
        self::createNewsTable(self::NEWS);
        self::createRolesTable(self::ROLES);
        self::createUsersTable(self::USERS);
        self::createTypeClientsTable(self::TYPE_CLIENTS);
        self::createInstructiveTable(self::INSTRUCTIVE);
        self::createManualsTable(self::MANUALS);
        self::createCategoriesTable(self::CATEGORIES);
        self::createProgramsTable(self::PROGRAMS);
        self::createGendersTable(self::GENDERS);
        self::createRestrictionsTable(self::RESTRICTIONS);
        self::createInstitutionsTable(self::INSTITUTIONS);
        self::createPhasesTable(self::PHASES);
        self::createCategoryProgramTable(self::CATEGORY_PROGRAM);
        self::createAudiosTable(self::AUDIOS);
        self::createEducationalLevelsTable(self::EDUCATIONAL_LEVELS);
        self::createClientsTable(self::CLIENTS);
        self::createInstructionsTable(self::INSTRUCTIONS);
        self::createQuestionsTable(self::QUESTIONS);
        self::createAnswersTable(self::ANSWERS);
        self::createClientQuestionTable(self::CLIENT_QUESTION);
        self::createPaymentsTable(self::PAYMENTS);
        self::createEvaluationsTable(self::EVALUATIONS);
        self::createEmotionalStatisticsTable(self::EMOTIONAL_STATISTICS);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables =
            [
                self::EMOTIONAL_STATISTICS,
                self::EVALUATIONS,
                self::PAYMENTS,
                self::CLIENT_QUESTION,
                self::ANSWERS,
                self::QUESTIONS,
                self::INSTRUCTIONS,
                self::CLIENTS,
                self::EDUCATIONAL_LEVELS,
                self::AUDIOS,
                self::CATEGORY_PROGRAM,
                self::PHASES,
                self::INSTITUTIONS,
                self::RESTRICTIONS,
                self::GENDERS,
                self::PROGRAMS,
                self::CATEGORIES,
                self::MANUALS,
                self::INSTRUCTIVE,
                self::TYPE_CLIENTS,
                self::USERS,
                self::ROLES,
                self::NEWS,
                self::SETTINGS
            ];
        self::dropIfExistCustom($tables);
    }

    private static function dropIfExistCustom($tables)
    {
        foreach ($tables as $table) {
            Schema::dropIfExists($table);
        }
    }

    /**
     * @property Table settings
     */
    protected static function createSettingTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('content')->nullable(true);
            $table->boolean('active')->default(true);
        });
    }

    /**
     * @property Table news
     */
    protected static function createNewsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url_image');
            $table->mediumText('content');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::SETTING_ID)->constrained();
        });
    }

    /**
     * @property Catalog roles
     */
    protected static function createRolesTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Table users
     */
    protected static function createUsersTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('last_name', 50);
            $table->string('second_last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId(self::ROL_ID)->constrained();
        });
    }

    /**
     * @property Catalog restrictions
     */
    protected static function createRestrictionsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Catalog genders
     */
    protected static function createGendersTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Catalog programs
     */
    protected static function createProgramsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * @property Catalog instructive
     */
    protected static function createInstructiveTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description');
            $table->string('url');
        });
    }

    /**
     * @property Catalog manuals
     */
    protected static function createManualsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->mediumText('description');
            $table->string('url');
        });
    }

    /**
     * @property Table categories
     */
    protected static function createCategoriesTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url_image');
            $table->mediumText('description');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::INSTRUCTIVE_ID)->nullable()->constrained();
            $table->foreignId(self::MANUAL_ID)->nullable()->constrained();
        });
    }

    /**
     * @property Catalog type_clients
     */
    protected static function createTypeClientsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Table institutions
     */
    protected static function createInstitutionsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->string('code')->unique();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::TYPE_CLIENT_ID)->constrained();
            $table->foreignId(self::PROGRAM_ID)->constrained();
        });
    }

    /**
     * @property Table phases
     */
    protected static function createPhasesTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('url_image');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::CATEGORY_ID)->constrained();
        });
    }

    /**
     * @property Table category_program
     */
    protected static function createCategoryProgramTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId(self::CATEGORY_ID)->constrained();
            $table->foreignId(self::PROGRAM_ID)->constrained();
        });
    }

    /**
     * @property Table audio
     */
    protected static function createAudiosTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->integer('number');
            $table->string('name');
            $table->mediumText('description')->nullable();
            $table->string('url_image');
            $table->string('url_audio');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::RESTRICTION_ID)->constrained();
            $table->foreignId(self::PHASE_ID)->constrained();
        });
    }

    /**
     * @property Catalog educational_levels
     */
    protected static function createEducationalLevelsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Table clients
     */
    protected static function createClientsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('second_last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->integer('age');
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId(self::GENDER_ID)->constrained();
            $table->foreignId(self::INSTITUTION_ID)->nullable()->constrained();
            $table->foreignId(self::PROGRAM_ID)->nullable()->constrained();
            $table->string('api_token')->nullable();
            $table->string('url_image')->nullable();
            $table->foreignId(self::EDUCATIONAL_LEVEL_ID)->nullable()->constrained();
            $table->integer('degree')->nullable();
            $table->boolean('teacher')->default(false);
        });
    }

    /**
     * @property Catalog instructions
     */
    protected static function createInstructionsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->nullable();
        });
    }

    /**
     * @property Catalog questions
     */
    protected static function createQuestionsTable($tableName)
    {
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->mediumText('description')->nullable();
            $table->foreignId(self::EDUCATIONAL_LEVEL_ID)->nullable()->constrained();
        });
    }

    /**
     * @property Catalog answers
     */
    protected static function createAnswersTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
    }

    /**
     * @property Table client_question
     */
    protected static function createClientQuestionTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->foreignId(self::QUESTION_ID)->constrained();
            $table->foreignId(self::CLIENT_ID)->constrained();
            $table->foreignId(self::ANSWER_ID)->constrained();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * @property Table payments
     */
    protected static function createPaymentsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->string('payment_method');
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->foreignId(self::AUDIO_ID)->constrained();
            $table->foreignId(self::CLIENT_ID)->constrained();
        });
    }

    /**
     * @property Table evaluations
     */
    protected static function createEvaluationsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->float('date',4,1);
            $table->mediumText('description');
            $table->timestamps();
            $table->foreignId(self::CLIENT_ID)->constrained();
        });
    }

    /**
     * @property Catalog emotional_statistics
     */
    protected static function createEmotionalStatisticsTable($tableName){
        Schema::create($tableName, function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('count')->default(0);
        });
    }
}
