# Установка Yii2 на чистую базу кода																									
1) добавить в зависимость Asset Plugin																									
php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta3"																									
2) добавить сам фреймверк																									
php composer.phar require "yiisoft/yii2:*"																									
																									
Строим фреймворк кода																									
1)	Создаем файл в каталоге web/index.php																								
```php <?php
//Включаем сам фреймверк
require(__DIR__.'/../vendor/yiisoft/yii2/Yii.php');
//Подключаем файл конфигурации
$config = require(__DIR__.'/../config/web.php');
//Создаем и немедленно запускаем приложение
(new yii\web\Application($config))->run();"
```
																									
2)	Cоздаем каталог с файлом config/web.php																								
```php<?php
return [
    'id'=>'crmapp',
    'basePath'=>realpath(__DIR__.'/../'),
    'components'=>[
        'request'=>[
            'cookieValidationKey'=>'secret_key123',
        ]
    ],
];
```
																									
Добавляем контроллер																									
Каждый контроллер должен обладать тремя особенностями																									
1)	Он должен находиться в пространстве имен, определенном в настройке controllerNamespace приложения																								
2)	Имя его класса должно иметь суффикс Сontroller																								
3)	Он должен быть подклассом класса \yii\base\Controller В случае контроллеров, которые предназначены для использования веб приложением, а не консольным,  мы должны расширять класс \yii\web\Controller . Для консольного приложения используйте \yii\console\Controller																								
Yii 2 использует автозагрузчик, совместимый с набором правил PSR-4 Если коротко, то такой автозагрузчик рассматривает пространства имен как пути в файловой системе, при условии что существует специальное корневое пространство имен, которое явно было отображено на определенный корневой каталог в базе кода																									
В нашем случае Yii2 самостоятельно определяет пространство имен \app , которое соответствует корневому каталогу проекта. В результате, например, значение настройки controllerNamespace по умолчанию, которым является строка \app\controllers соответствует подкаталогу controllers в корневом каталоге, поэтому все определения классов контроллеров, должны находиться там.																									
Также каждый клас, который должен быть доступен через автозагрузчик Yii2, должен находиться в отдельном файле, названном так же, как и сам класс																									
																									
1)	Создаем файл в папке controllers/SiteController.php																								
```php<?php
namespace app\controllers;
use \yii\web\Controller;
class SiteController extends Controller
{
    public function actionIndex()
    {
        return 'Our CRM';
    }
}
```
Облегчение отладки возможных ошибок																									
Вносим изменения в файл index.php																									
```php<?php
define('YII_DEBUG',true);
//Включаем сам фреймверк
require(__DIR__.'/../vendor/yiisoft/yii2/Yii.php');
ini_set('display_errors',true);
//Подключаем файл конфигурации
$config = require(__DIR__.'/../config/web.php');
//Создаем и немедленно запускаем приложение
(new yii\web\Application($config))->run();
```
Cоздаем слои данных и приложения																									
1)	Создаем контроллер маршрута - файл СustomersController.php в папке controllers																								
2)	Согласно настройкам по умолчанию, маршрут /customers соответсвует маршруту /customers/index. Нам нужно предоставить метод под названием actionIndex, чтобы включить этот маршрут.																								
	Что мы будем делать в ответ на запрос по этому маршруту????																								
	Традиционно в данном случае возвращают список всех записей, имеющихся в БД. У нас нет теста на эту функциональность, поэтому мы избавим себя от данной задачи в рамках текущей главы																								
	Однако будет довольно глупо считать, что нам никогда не понадобится такая функциональность.																								
	На самом деле нам и так нужно возаращать список записей о клиентах, только не обо всех клиентах, а соответственно запросу по номеру телефона. 																								
	То есть мы будем ожидать, что нам передадут некоторый параметр запроса, и отсюда следует, что наш метод actionIndex должен выглядеть следующим образом																								
```php<?php
namespace app\controllers;
use \yii\web\Controller;
class CustomersController extends Controller
{
    public function actionIndex()
    {
       $records = $this->findRecordsByQuery();
        return $this->render('index',compact('records'));
    }
}
```
Теперь нам осталось только разобраться с методом findByQuery. Чтобы доделать его, нам сначала нужна база данных																								
Но до этого давайте определимся с моделью клиента																								
Определение модели клиента на слое данных																									
Модель клиента это просто класс, хранящий данные, так что нам на него не нужны тесты. Вот как мы его определим																									
1)	Создаем файл в каталоге models/customer/Customer.php					
2) Cоздаем файл в каталоге models/customer/Phone.php																			
```php<?php
namespace app\models\customer;
class Customer {
    /** @var string */
    public $name;

    /** @var \DateTime */
    public $birth_date;

    /** @var string */
    public $notes = '';

    /** @var PhoneRecord[] */
    public $phones = [];

    public function __construct($name, $birth_date)
    {
        $this->name = $name;
        $this->birth_date = $birth_date;
    }

}

<?php
namespace app\models\customer;

class Phone {
    /** @var string */
    public $number;
    public function __construct($number)
    {
        $this->number = $number;
    }
}	
```
Таким образом, наш агрегат Customer будет не более чем структурой данных, хранящей другие структуры даннх, состоящие из значений примитивных типов. Мы сделали невозможными создание объектов класса 																									
Сustomer без указания имени и даты рождения, но, кроме этого, все поля публичные, так что любой может делать все что угодно, с агрегатом.																									
Подготовка базы данных																									
1)	Cоздаем БД																								
	create database `crmapp` default character set utf8 default collate utf8_unicode_ci;																								
Для того чтобы использовать миграции нам необходимо выполнить следующие вещи																									
1)	Создаем файл в корне проекта yii.php
```php
<?php
define('YII_DEBUG', true);

require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

$config = require(__DIR__ . '/config/console.php');

$application = new yii\console\Application($config);
$exitCode = $application->run();
exit($exitCode);
```
Фактически это обрезанная версия скрипта yii который поставляется с базовым шаблоном																				
2) Этому скрипту нужен файл конфигурации под названием config/console.php																									
```php<?php
return[
    'id'=>'crmapp-console',
    'basePath'=>dirname(__DIR__),
    'components'=>[
        'db'=>require(__DIR__.'/db.php'),
    ],
];	
```php
3)	Создаем файл сonfig/db.php																								
	```php<?php
return[
    'class'=>'\yii\db\Connection',
    'dsn'=>'mysql:host=localhost;dbname=crmapp',
    'username'=>'root',
    'password'=>''
];			
```
4)	Выполнеяем команду:																								
	php yii.php migrate/create init_customer_table																								
																									
5)	В папке migrations находим создавшийся файл																								
	Вносим изменения																								
  ```php
	public function up()
    {
        $this->createTable(
            'customer',
            [
                'id' => 'pk',
                'name' => 'string',
                'birth_date' => 'date',
                'notes' => 'text',
            ],
            'ENGINE=InnoDB'
        );

    }

    public function down()
    {
        $this->dropTable('customer');
    }																								
	```																								
6)	"Выполняем команду php yii.php migrate/create init_phones_table																								
7)	В папке migration находим создавшийся файл																								
	Вносим изменения																								
  ```php
	public function up()
    {
        $this->createTable(
            'phone',
            [
                'id' => 'pk',
                'customer_id' => 'int',
                'number' => 'string',
            ]
        );
        $this->addForeignKey('customer_phone_numbers', 'phone', 'customer_id', 'customer', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('customer_phone_numbers', 'phone');
        $this->dropTable('phone');
    }
    ```
8)Выполняем команду php yii.php migrate																								
	Она выполнит все описанные выше миграции																								
																									
9)	Вставляем в файл конфигурации web.php строрку которая отвечает за подключение к базе данных																								
	```php<?php
return [
    'id'=>'crmapp',
    'basePath'=>realpath(__DIR__.'/../'),
    'components'=>[
        'request'=>[
            'cookieValidationKey'=>'secret_key123',
        ],
        'db'=>require(__DIR__.'/db.php'),

    ],
];```																								
ORM в Yii																									
Active Record																									
1) Создаем файл models/customer/СustomerRecord.php																									
```php<?php
namespace app\models\customer;
use yii\db\ActiveRecord;

class CustomerRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            ['id', 'number'],
            ['name', 'required'],
            ['name', 'string', 'max' => 256],
            ['birth_date', 'date', 'format' => 'Y-m-d'],
            ['notes', 'safe']
        ];
    }
}
```
2) Создаем файл models/customerPhoneRecord.php																									
```php<?php
namespace app\models\customer;
use yii\db\ActiveRecord;

class PhoneRecord extends ActiveRecord
{
    public static function tableName()
    {
        return 'phone';
    }

    public function rules()
    {
        return [
            ['customer_id', 'number'],
            ['number', 'string'],
            [['customer_id', 'number'], 'required'],
        ];
    }
}
```																							
3) Создаем метод для сохранения модели клиента в базе данных в файле СustomersController.php																									
"//Метод для сохранения модели клиента в базе данных
```php
    private function store(Customer $customer)
    {
        $customer_record  = new CustomerRecord();
        $customer_record->name = $customer->name;
        $customer_record->birth_date = $customer->birth_date->format('Y-m-d');
        $customer_record->notes = $customer->notes;
        $customer_record->save();

        foreach ($customer->phones as $phone)
        {
            $phone_record = new PhoneRecord();
            $phone_record->number = $phone->number;
            $phone_record->customer_id = $customer_record->id;
            $phone_record->save();
        }
    }```
    Как видно мы получаем экземпляр Сustomer, но используем активные записи, для того чтобы сохранить данные из него в БД.																				
4) Создаем метод для конвертирования активніх записей в экземпляр класса Сustomer																									
```php //Метод для конвертирования активных записей в экземпляр класса Сustomer
    private function makeCustomer(CustomerRecord $customer_record,PhoneRecord $phone_record)
    {
        $name = $customer_record->name;
        $birth_date = new \DateTime($customer_record->birth_date);

        $customer = new Customer($name, $birth_date);
        $customer->notes = $customer_record->notes;
        $customer->phones[] = new Phone($phone_record->number);
        return $customer;
    }```
Здесь мы принимаем единственный экземпляр PhoneRecord , потому что прямо сейчас мы имеем дело только с одним номером телефона на клиента.
Этот метод нужно будет заменить когда появится необходимость поддерживать несколько телефонных номеров на клиента. 
Эти 2 метода по сути, являются слоем трансляции между Yii и нашей моделью предметной области.																			
Создание пользовательского интерфейса																									
Что для нас должен сделать контроллер, когда мы прибудем на URL / customer/add ? Ну, он должен просто отри
совать для нас пользовательский интерфейс:																								
Создаем файл views/customer/add.php																									
Что мы хотим видить на этой странице? Согласно нашему приемочному тесту, там должна быть форма для
ввода информации о пользователе, включая номер его телефона, а также кнопка Submit"																									
Yii содержит широкий выбор вспомогательных методов, для того чтобы быстро и легко составлять веб-формы. 
Центральная концепция позади них - это класс ActiveForm. Мы инициализируем ActiveForm и затем используем его методы, для того чтобы генери
ровать HTML-код для полей ввода, соответствующих атрибутам моделей. Вот так должен выглядеть файл views/customers/add.php"																									
```php<?php
use app\models\customer\CustomerRecord;
use app\models\customer\PhoneRecord;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * Add Customer UI.
 *
 * @var View $this
 * @var CustomerRecord $customer
 * @var PhoneRecord $phone
 */

$form = ActiveForm::begin([
    'id' => 'add-customer-form',
]);

echo $form->errorSummary([$customer, $phone]);
echo $form->field($customer, 'name');
echo $form->field($customer, 'birth_date');
echo $form->field($customer, 'notes');

echo $form->field($phone, 'number');

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
ActiveForm::end();
```																									
Но для того, чтобы это представление молго работать, у него должен быть доступ к объектам моделей - в нашем случае $customer
и $phone. Это делается с использованием специального механизма передачи данных из класса View в Controller через второй аргумент
метода render() . В целом мы, как минимум должны иметь вот такое содержимое метода ActionAdd(), чтобы форма была корректно отрисована:"																									
Вносим изменения в файл CustomersController.php																									
```php public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;

        return $this->render('add',compact('customer','phone'));
    }
    ```
Вводный курс маршрутизации																									
1) Создаем файл web/.htaccess																									
"RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d

RewriteRule . index.php"																									
																									
2) Добавляем следующее в раздел сomponents config/web.php	
```php
'urlManager' =>[
            'enablePrettyUrl'=>true,
            'showScriptName'=>false
        ]
        ```
Теперь у нас адекватные ссылки																									
																									
Шаблоны																									
"По умолчанию, когда мы вызываем Сontroller.render() этот метод подразумевает, что представление, которое вы отрисовываете, это просто отдельный фрагмент, который
нужно вставить в другой скрипт, называющийся шаблоном (layout) По умолчанию все контроллеры ищут шаблон в файле views/layouts/main.php Результат рендеринга того
ради чего мы вызывали метод render(). передается в шаблон в виде строковой переменной под названием $content За испключением этого, шаблон является просто
еще одним файлом представления. Ожидается, что у внешнего вида нашего приложения есть некоторые элементы, представленные на всех страницах, и шаблон - это
именно то место, где их ннадо держать."																									
Нас вполне устраивают настройки по умолчанию, так что давайте просто создадим базовый фреймворк HTML-5 страницу и увидим уже наконец, нашу форму добавления клиента																									
Создаем файл views/layouts/main.php		
```php
"<!doctype html>
<html lang=""en"">
<head>
    <meta charset=""UTF-8"">
    <title>CRM</title>
</head>
<body>
    <?=$content;?>
</body>
</html> ```																				
Итак. Можно открыть путь сustomers/add и все должно рендерится																									
																									
Завершение интерфейса добавления клиента																									
"Идиоматический код, основанный на Yii подразумевает, что формы отправляют данные на тот же маршрут, который использовался, чтобы отрисовать их.
Мы будем использовать тот же подход. Таким образом нам нужно обрабатывать возможные входные данные в методе actionAdd()
Мы делаем это следующий способом:"																									
```php public function actionAdd()
    {
        $customer = new CustomerRecord;
        $phone = new PhoneRecord;

        if($this->load($customer,$phone,$_POST))
        {
            //print_r($this->makeCustomer($customer,$phone));
            $this->store($this->makeCustomer($customer,$phone));
            return $this->redirect('/customers?phone_number='.$phone->number);
        }
        return $this->render('add',compact('customer','phone'));
    }```
Обратите внимание на выделенные строчки. Когда мы успешно загрузили данные, отправленные
нам ПОСТ - запросом, мы сохраняем получившуюся модель клиента в базе данных при 
помощи методов, определенных в нашем слое трансляции. Метод под названием load() - это
сокращение для следующих четырех проверок:"																		
Добавляем метод load()																									
```php private function load(CustomerRecord $customer, PhoneRecord $phone, array $post)
    {
        return $customer->load($post)
        and $phone->load($post)
        and $customer->validate()
        and $phone->validate(['number']);
    }
    ```
Вот эти 4 проверки:
1) \yii\base\Model::load() - это встроенный метод, позволяющий заполнить атрибуты модели данными, переданными
ПОСТ - запросом, который условно сделал виджет ActiveForm
2) \yii\base\Model::validate() - это встроенный метод, который проверяет значения атрибутов модели на соответствие правилам валидации, определенным в 
\yii\base\Model::rules(). Заметьте, что мы можем провести валидацию только некоторых избранных атрибутов, а не всех сразу. В нашем случае нам нужно провести 
валидацию лишь атрибута number, потому что в данных формы, переданных нам, еще нет поля сustomer_id а оно было объявлено обязательным
3) \yii\db\BaseActiveRecord::save() вызывает validate(), перед тем как на самом деле сохранить данные в БД.
Идея, лежащая в основе реализации validate(), заключается в том, что если есть какие-то ошибочные значения, то этот метод сохраняет сообщение об ошибке в 
специальном атрибуте \
yii\base\Model::$errors. Именно это позволяет нам использовать метод под названием errorSummary у класса ActiveForm. Он проверит
сообщения об ошибке одно за другим и 
красиво их распечатает."																		
"Когда элемент успешно добавлен, мы делаем перенаправление на список клиентов. Это возможно
пока что самое интересное действие контроллера"																									
```php public function actionIndex()
    {
        if(!empty(Yii::$app->request->get('phone_number')))
            $records = $this->findRecordsByQuery();
    
        return $this->render('index',compact('records'));
    } 
    ```
																									
"Здесь же мы должны выводить список найденных записей. Однако теперь мы на самом деле готовы
найти записи согласно запросу. Обычно мы просто обращаемся к суперглобальной переменной ГЕТ, чтобы
получать параметры запроса, нов Yii есть своя обертка вокруг него, по этому давайте использовать ее. 
Специальный компонент приложения под названием Request манипулирует параметрами запроса и предоставляет метод под названием
GET С этим методом мы можем проверить, был ли некоторый параметр ГЕТ установлен в какое-либо значение."																									
```php private function findRecordsByQuery()
    {
        $number = Yii::$app->request->get('phone_number');
        $records = $this->getRecordsByPhoneNumber($number);
        $dataProvider = $this->wrapIntoDataProvider($records);
        return $dataProvider;
    }```
Здесь мы немного смухлевали: вы еще не знаете, что такое провайдеры данных (wrapIntoDataProvider) 
Чтобы понять зачем нам нужно оборачивать записи, которые наш запрос нам предоставляет, в провай
дер данных, нам нужно знать, как мы собираемся отрисовывать результаты"																					
Виджеты																									
"Сами по себе провайдеры данных не важны. Их важность в том, что практически все виджеты, встроенные в Yii , используют их в качестве источника моделей для отрисовки
Виджет можно представить себе как вариацию класса представления Views MVC модели . с некоторой дополнительной логикой."																									
Типичными встроенными виджетами являются:																									
ListView	для инкапсуляции отрисовки списка моделей																								
DetalView	для инкапсуляции отрисовки детальной информации об одной конкретной модели																								
GridView	для инкапсуляции отрисовки табличного представления набора моделей. 																								
Виджеты вызываются следующим способом:																									
echo \yii\widgets\DetalView::widget($settings);																									
Настройки передаются в виджеты в виде ассоциативных массивов начальных значений переменных - членов класса виджета. Учитывая объем самодокументации у всех
классов Yii, даже без какой либо пользовательской документации и примеров кода вы можете просто открыть определение класса виджета и разобраться, как настраивать его"																									
"Итак, нам нужны провайдеры данных, потому что они инкапсулируют действие по поиску набора моделей, требуемых для отрисовки в данный момент. Они делают сортировку, разбивку на страници и фильтрацию за Вас. Они наиболее полезны, когда вы используете ActiveRecord
как модели предметной области в вашем приложении. То есть когда у Вас есть однозначное отображение таблиц БД на модели предметной области. 
В нашем случае когда мы делаем все возможное для того, чтобы отвязаться от ОРМ, провайдеры данных нам нужны только как оберки вокруг наших данных, чтобы удовлетворить требованиям виджетов"																									
Пользовательский интерфейс списка клиентов																									
Идеальный провайдер данных для наших целей - это \yii\data\ArrayDataProvider который просто получает список готовых моделей и оборачивает их
позволяя скармливать их виджетам."																									
Вот что мы деламе в методе wrapIntoDataProvier																									
```php private function wrapIntoDataProvider($data)
    {
        return new ArrayDataProvider(
            [
                'allModels'=>$data,
                'pagination'=>false,
            ]
        );
    }```
Установка настройки pagination в значение false означает, что мы хотим отключить возможности
разбивки на страницы, так как пока что интерфейс перехода между страницами под списокм,
если вы посмотрите на него, когда мы все доделаем, выглядит все просто ужасно."																						
Собственно, данные для того, чтобы вложить их в DataProvider и отправить на рендеринг, находятся следующим образом:																									
```php private function getRecordsByPhoneNumber($number)
    {
        $phone_record = PhoneRecord::findOne(['number'=>$number]);
        if(!$phone_record)
            return [];
        $customer_record = CustomerRecord::findOne($phone_record->customer_id);
        if(!$customer_record)
            return [];

        return [$this->makeCustomer($customer_record,$phone_record)];
    }
    ```
Построить пользовательский интерфейс списка клиентов имеет смысл на основе виджета \yii\widgets\ListView Вот как нужно его настроить :																									
views/customers/index.php	
```php
echo \yii\widgets\ListView::widget(
    [
        'options' => [
            'class' => 'list-view',
            'id' => 'search_results'
        ],
        'itemView' => '_customer',
        'dataProvider' => $records
    ]
);```			
"Элемент ItemView в настройках виджета содержит название отдельного файла представления,
который будет использован для того, чтобы , собственно, отрисовывать каждую отельную
модель из предоставленного провайдера данных. его имеет смысл определить в терминах
виджета \yii\widgets\DetalView "																						
Реализация файла views/customers/_customer.php																									
```php <?php
/**
 * @var Customer $model
 */
use app\models\customer\Customer;

echo \yii\widgets\DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'name'],
            ['attribute' => 'birth_date', 'value' => $model->birth_date->format('Y-m-d')],
            'notes:text',
            ['label' => 'Phone Number', 'attribute' => 'phones.0.number']
        ]
    ]);
```																								
Пользовательский интерфейс запроса к БД																									
Последняя деталь пользовательского интерфейса смехотворно проста:																									
```php public function actionQuery()
    {
        return $this->render('query');
    }
    ```
Далее мы просто покажем вручную написанную ХТМЛ форму на этой странице																									
views/customers/query.php																									
```php <?php
use yii\helpers\Html;

echo Html::beginForm(['/customers'], 'get');
echo Html::label('Phone number to search:', 'phone_number');
echo Html::textInput('phone_number');
echo Html::submitButton('Search');
echo Html::endForm();
```php																								
