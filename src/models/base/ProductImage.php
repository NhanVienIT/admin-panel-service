<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use \app\models\ProductImageQuery;

/**
 * This is the base-model class for table "product_images".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $image
 * @property array $gallery
 * @property string $created_at
 * @property string $updated_at
 */
abstract class ProductImage extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_images';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['timestamp'] = [
            'class' => TimestampBehavior::class,
            'value' => (new \DateTime())->format('Y-m-d H:i:s'),
                        ];
        
    return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $parentRules = parent::rules();
        return ArrayHelper::merge($parentRules, [
            [['product_id', 'image', 'gallery'], 'default', 'value' => null],
            [['product_id'], 'integer'],
            [['gallery'], 'safe'],
            [['image'], 'string', 'max' => 255]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'image' => 'Image',
            'gallery' => 'Gallery',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ]);
    }

    /**
     * @inheritdoc
     * @return ProductImageQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductImageQuery(static::class);
    }
}
