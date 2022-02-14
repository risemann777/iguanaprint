<?php

/**
 * This is the model class for table "{{block}}".
 *
 * The followings are the available columns in table '{{block}}':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $active
 * @property integer $sort
 * @property string $list_page_url
 * @property string $detail_page_url
 * @property integer $picture
 * @property string $description
 * @property string $is_element_preview_picture
 * @property string $preview_picture_hint
 * @property string $is_element_preview_text
 * @property string $is_element_detail_picture
 * @property string $detail_picture_hint
 * @property string $is_element_detail_text
 * @property string $is_element_detail_text_html
 * @property string $is_element_gallery
 * @property string $is_sections
 * @property string $section_picture_hint
 * @property string $section_detail_picture_hint
 * @property string $is_shop
 * @property string $is_file
 * @property string $is_active_from
 * @property string $is_active_to
 * @property string $is_tag
 * @property string $is_element_popular
 * @property string $popular_option_name
 * @property string $sign_sections_name
 * @property string $sign_section_name
 * @property string $sign_section_add
 * @property string $sign_section_edit
 * @property string $sign_section_delete
 * @property string $sign_elements_name
 * @property string $sign_element_name
 * @property string $sign_element_add
 * @property string $sign_element_edit
 * @property string $sign_element_delete
 * @property string $sign_element_preview_text_name
 * @property string $sign_element_detail_text_name
 * @property string $sign_element_preview_picture_name
 * @property string $sign_element_detail_picture_name
 * @property string $meta_h1
 * @property string $meta_title
 * @property string $meta_keywords
 * @property string $meta_description
 */
class Block extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{block}}';
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
			array('sort, picture', 'numerical', 'integerOnly'=>true),
			array('name, code, list_page_url, detail_page_url, preview_picture_hint, detail_picture_hint, section_picture_hint, section_detail_picture_hint, popular_option_name, sign_sections_name, sign_section_name, sign_section_add, sign_section_edit, sign_section_delete, sign_elements_name, sign_element_name, sign_element_add, sign_element_edit, sign_element_delete, sign_element_preview_text_name, sign_element_detail_text_name, sign_element_preview_picture_name, sign_element_detail_picture_name, meta_h1, meta_title, meta_keywords, meta_description', 'length', 'max'=>255),
			array('active, is_element_preview_picture, is_element_preview_text, is_element_detail_picture, is_element_detail_text, is_element_detail_text_html, is_element_gallery, is_sections, is_shop, is_file, is_active_from, is_active_to, is_tag, is_element_popular', 'length', 'max'=>1),
			array('description', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, code, active, sort, list_page_url, detail_page_url, picture, description, is_element_preview_picture, preview_picture_hint, is_element_preview_text, is_element_detail_picture, detail_picture_hint, is_element_detail_text, is_element_detail_text_html, is_element_gallery, is_sections, section_picture_hint, section_detail_picture_hint, is_shop, is_file, is_active_from, is_active_to, is_tag, is_element_popular, popular_option_name, sign_sections_name, sign_section_name, sign_section_add, sign_section_edit, sign_section_delete, sign_elements_name, sign_element_name, sign_element_add, sign_element_edit, sign_element_delete, sign_element_preview_text_name, sign_element_detail_text_name, sign_element_preview_picture_name, sign_element_detail_picture_name, meta_h1, meta_title, meta_keywords, meta_description', 'safe', 'on'=>'search'),
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
			'code' => 'Code',
			'active' => 'Active',
			'sort' => 'Sort',
			'list_page_url' => 'List Page Url',
			'detail_page_url' => 'Detail Page Url',
			'picture' => 'Picture',
			'description' => 'Description',
			'is_element_preview_picture' => 'Is Element Preview Picture',
			'preview_picture_hint' => 'Preview Picture Hint',
			'is_element_preview_text' => 'Is Element Preview Text',
			'is_element_detail_picture' => 'Is Element Detail Picture',
			'detail_picture_hint' => 'Detail Picture Hint',
			'is_element_detail_text' => 'Is Element Detail Text',
			'is_element_detail_text_html' => 'Is Element Detail Text Html',
			'is_element_gallery' => 'Is Element Gallery',
			'is_sections' => 'Is Sections',
			'section_picture_hint' => 'Section Picture Hint',
			'section_detail_picture_hint' => 'Section Detail Picture Hint',
			'is_shop' => 'Is Shop',
			'is_file' => 'Is File',
			'is_active_from' => 'Is Active From',
			'is_active_to' => 'Is Active To',
			'is_tag' => 'Is Tag',
			'is_element_popular' => 'Is Element Popular',
			'popular_option_name' => 'Popular Option Name',
			'sign_sections_name' => 'Sign Sections Name',
			'sign_section_name' => 'Sign Section Name',
			'sign_section_add' => 'Sign Section Add',
			'sign_section_edit' => 'Sign Section Edit',
			'sign_section_delete' => 'Sign Section Delete',
			'sign_elements_name' => 'Sign Elements Name',
			'sign_element_name' => 'Sign Element Name',
			'sign_element_add' => 'Sign Element Add',
			'sign_element_edit' => 'Sign Element Edit',
			'sign_element_delete' => 'Sign Element Delete',
			'sign_element_preview_text_name' => 'Sign Element Preview Text Name',
			'sign_element_detail_text_name' => 'Sign Element Detail Text Name',
			'sign_element_preview_picture_name' => 'Sign Element Preview Picture Name',
			'sign_element_detail_picture_name' => 'Sign Element Detail Picture Name',
			'meta_h1' => 'Meta H1',
			'meta_title' => 'Meta Title',
			'meta_keywords' => 'Meta Keywords',
			'meta_description' => 'Meta Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('active',$this->active,true);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('list_page_url',$this->list_page_url,true);
		$criteria->compare('detail_page_url',$this->detail_page_url,true);
		$criteria->compare('picture',$this->picture);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('is_element_preview_picture',$this->is_element_preview_picture,true);
		$criteria->compare('preview_picture_hint',$this->preview_picture_hint,true);
		$criteria->compare('is_element_preview_text',$this->is_element_preview_text,true);
		$criteria->compare('is_element_detail_picture',$this->is_element_detail_picture,true);
		$criteria->compare('detail_picture_hint',$this->detail_picture_hint,true);
		$criteria->compare('is_element_detail_text',$this->is_element_detail_text,true);
		$criteria->compare('is_element_detail_text_html',$this->is_element_detail_text_html,true);
		$criteria->compare('is_element_gallery',$this->is_element_gallery,true);
		$criteria->compare('is_sections',$this->is_sections,true);
		$criteria->compare('section_picture_hint',$this->section_picture_hint,true);
		$criteria->compare('section_detail_picture_hint',$this->section_detail_picture_hint,true);
		$criteria->compare('is_shop',$this->is_shop,true);
		$criteria->compare('is_file',$this->is_file,true);
		$criteria->compare('is_active_from',$this->is_active_from,true);
		$criteria->compare('is_active_to',$this->is_active_to,true);
		$criteria->compare('is_tag',$this->is_tag,true);
		$criteria->compare('is_element_popular',$this->is_element_popular,true);
		$criteria->compare('popular_option_name',$this->popular_option_name,true);
		$criteria->compare('sign_sections_name',$this->sign_sections_name,true);
		$criteria->compare('sign_section_name',$this->sign_section_name,true);
		$criteria->compare('sign_section_add',$this->sign_section_add,true);
		$criteria->compare('sign_section_edit',$this->sign_section_edit,true);
		$criteria->compare('sign_section_delete',$this->sign_section_delete,true);
		$criteria->compare('sign_elements_name',$this->sign_elements_name,true);
		$criteria->compare('sign_element_name',$this->sign_element_name,true);
		$criteria->compare('sign_element_add',$this->sign_element_add,true);
		$criteria->compare('sign_element_edit',$this->sign_element_edit,true);
		$criteria->compare('sign_element_delete',$this->sign_element_delete,true);
		$criteria->compare('sign_element_preview_text_name',$this->sign_element_preview_text_name,true);
		$criteria->compare('sign_element_detail_text_name',$this->sign_element_detail_text_name,true);
		$criteria->compare('sign_element_preview_picture_name',$this->sign_element_preview_picture_name,true);
		$criteria->compare('sign_element_detail_picture_name',$this->sign_element_detail_picture_name,true);
		$criteria->compare('meta_h1',$this->meta_h1,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keywords',$this->meta_keywords,true);
		$criteria->compare('meta_description',$this->meta_description,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Block the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	// проверка блока на пустоту
	public static function isEmpty($block_id)
	{
		$id = intval($block_id);

		if($id > 0){
			// проверим наличие разделов и элементов, привязанных к блоку
			$sections_count = BlockSection::model()->count('block_id = '.$id);
			$elements_count = BlockElement::model()->count('block_id = '.$id);

			if($sections_count > 0 || $elements_count > 0){
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}
}
