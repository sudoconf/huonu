<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%authorize_user}}".
 *
 * @property string $authorize_user_id
 * @property string $taobao_user_id 淘宝账号对应的ID（该字段为所有其他表的主键或联合主键之一）
 * @property string $taobao_user_nick 淘宝账号
 * @property string $access_token 用户的许可令牌，原sessionkey
 * @property string $refresh_token 用来刷新access_token
 * @property int $expires_in Access token有效时
 * @property int $re_expires_in Refresh token有效时间
 * @property int $r1_expires_in r1级别API或字段时间
 * @property int $r2_expires_in r2级别API或字段时间
 * @property int $w1_expires_in w1级别API或字段时间
 * @property int $w2_expires_in w2级别API或字段时间
 * @property string $r1_valid r1级别API或字段的访问过期时间，单位毫秒，unix时间
 * @property string $r2_valid r2级别API或字段的访问过期时间，单位毫秒，unix时间
 * @property string $w1_valid w1级别API或字段的访问过期时间，单位毫秒，unix时间
 * @property string $w2_valid w2级别API或字段的访问过期时间，单位毫秒，unix时间
 * @property string $expire_time Access token过期时间,单位毫秒，unix时间
 * @property string $refresh_token_valid_time Refresh token过期时间,单位毫秒，unix时间
 * @property string $token_type Access token的类型，目前只支持bearer
 * @property string $expire_date
 */
class AuthorizeUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'taobao_authorize_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['taobao_user_id'], 'required'],
            [['expires_in', 're_expires_in', 'r1_expires_in', 'r2_expires_in', 'w1_expires_in', 'w2_expires_in', 'r1_valid', 'r2_valid', 'w1_valid', 'w2_valid', 'expire_time', 'refresh_token_valid_time'], 'integer'],
            [['expire_date'], 'safe'],
            [['taobao_user_id', 'taobao_user_nick', 'access_token', 'refresh_token'], 'string', 'max' => 255],
            [['token_type'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'authorize_user_id' => 'Authorize User ID',
            'taobao_user_id' => 'Taobao User ID',
            'taobao_user_nick' => 'Taobao User Nick',
            'access_token' => 'Access Token',
            'refresh_token' => 'Refresh Token',
            'expires_in' => 'Expires In',
            're_expires_in' => 'Re Expires In',
            'r1_expires_in' => 'R1 Expires In',
            'r2_expires_in' => 'R2 Expires In',
            'w1_expires_in' => 'W1 Expires In',
            'w2_expires_in' => 'W2 Expires In',
            'r1_valid' => 'R1 Valid',
            'r2_valid' => 'R2 Valid',
            'w1_valid' => 'W1 Valid',
            'w2_valid' => 'W2 Valid',
            'expire_time' => 'Expire Time',
            'refresh_token_valid_time' => 'Refresh Token Valid Time',
            'token_type' => 'Token Type',
            'expire_date' => 'Expire Date',
        ];
    }
}
