<?php

namespace common\models;

use Yii;
use yii\web\IdentityInterface;
use yii\base\NotSupportedException;


/**
 * This is the model class for table "admin".
 *
 * @property integer $admin_id
 * @property string $username
 * @property string $password_hash
 * @property string $auth_key
 * @property string $truename
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Admin extends \yii\db\ActiveRecord implements IdentityInterface
{
	
	public $password;
	public $repassword;
	public $newpassword;
	public $oldpassword;
	public $_user;
	public $rememberMe;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'truename', 'oldpassword', 'password', 'repassword','status'], 'required'],
            ['username', 'unique','message' => '该用户名已存在','on'=>['add','edit']],
            ['repassword','compare','compareAttribute'=>'password','message'=>'两次输入的密码不一致！'],
            [['username'], 'string', 'max' => 12],
            [['password_hash'], 'string', 'max' => 60],
            [['truename'], 'string', 'max' => 6],
            ['password', 'validatePassword','on'=>'login'],
        ];
    }
    
    /**
     * 场景设置(non-PHPdoc)
     * add 新增  edit 修改  pwd 修改密码  login 登陆  set 修改资料
     * @see \yii\base\Model::scenarios()
     */
    public function scenarios(){
    	return [
			'add' => ['username','truename','password','repassword'],
			'edit' => ['username','truename','status', 'newpassword'],
			'pwd' => ['oldpassword','password','repassword'],
			'login' => ['username','password'],
			'set' => ['truename'],
    	    'other'=>[],
    	];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admin_id' => 'Admin ID',
            'username' => '用户名',
            'password_hash' => '密码',
            'auth_key' => 'Auth Key',
            'truename' => '真实姓名',
            'status' => '状态',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'password' => '密码',
            'repassword' => '确认密码',
            'oldpassword' => '原密码',
            'newpassword' => '新密码',
        ];
    }
    
    /**
     * 注册管理员
     * @return boolean
     */
    public function saveData(){
    	if($this->scenario == 'add'){
//    		$this->create_person = $this->update_person = \Yii::$app->user->id;
    		$this->setPassword();
    		$this->setAuthKey();
    		$this->create_time = $this->update_time = date('Y-m-d H:i:s',time());
    	}else{
    		if(!empty($this->newpassword))$this->setPassword($this->newpassword);
    		$this->update_time = date('Y-m-d H:i:s',time());
    		$this->update_person = \Yii::$app->user->id;
    	}
    	return $this->save();
    }
    
    /**
     * 给密码加密，并赋值给$this->password_hash;
     * @param string $password  加密前的密码
     */
    public function setPassword($password=''){
    	if(empty($password))$password = $this->password;
    	$this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    /**
     * 生成自动登录密钥，并赋值给$this->auth_key
     */
    public function setAuthKey(){
    	$this->auth_key = Yii::$app->security->generateRandomString();
    }
    
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
    	if (!$this->hasErrors()) {
    		$user = $this->getUser();
    		if (!$user || !Yii::$app->security->validatePassword($this->password, $user->password_hash)) {
    			$this->addError($attribute, '帐号或密码错误');
    		}
    	}
    }
    
    public function login(){
    	if ($this->validate()) {
//    		print_r($this->getUser());exit;
    		return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
    	} else {
    		return false;
    	}
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
    	if ($this->_user === null) {
    		$this->_user = $this->findByUsername();
    	}
    
    	return $this->_user;
    }
    
    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public function findByUsername()
    {
    	return static::findOne(['username' => $this->username, 'status' => 0]);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
    	return $this->getPrimaryKey();
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    	return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    	return $this->getAuthKey() === $authKey;
    }
    
    
	/**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['admin_id' => $id, 'status' => 0]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * 成功登录
     */
    public function successLogin(){
        $user = $this->getUser();
        $user->last_time = date('Y-m-d H:i:s',time());
        
        $user->scenario = 'other';
        $user->save();
        
        $this->loginLogs('success');
    }
    
    /**
     * 记录登录日志
     * @param string $status
     */
    public function loginLogs($status = 'error'){
        $model = new AdminLogs();
        $model->username = $this->username;
        $model->password = ($status != 'success') ? $this->password : '';
        $model->ip = \Yii::$app->request->userIP;
        $model->add_time = date('Y-m-d H:i:s',time());
        $model->save();
        if($model->errors){
            print_r($user->errors);
            exit;
        }
    }
    
	
}
