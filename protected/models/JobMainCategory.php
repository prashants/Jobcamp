<?php

/**
 * This is the model class for table "job_main_category".
 *
 * The followings are the available columns in table 'job_main_category':
 * @property integer $id
 * @property string $name
 *
 * The followings are the available model relations:
 * @property JobSubCategory[] $jobSubCategories
 */
class JobMainCategory extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return JobMainCategory the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'job_main_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'jobSubCategories' => array(self::HAS_MANY, 'JobSubCategory', 'job_main_category_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	/**
	 * Retrive list of all values for display in dropdownlist
	 * @return array of id and values
	 */
	function getAll()
	{
		$list_data = array();
		$list_query = $this->findAll();
		foreach ($list_query as $row)
		{
			$list_data[$row->id] = $row->name;
		}
		return $list_data;
	}

	/**
	 * Retrive the name of the id specified
	 * @return string name if found or empty string if not found
	 */
	function getName($item_id)
	{
		$item_data = $this->findByPk($item_id);
		if ($item_data)
			return $item_data->name;
		else
			return '';
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}