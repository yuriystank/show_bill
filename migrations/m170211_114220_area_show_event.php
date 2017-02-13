<?php

use yii\db\Migration;

class m170211_114220_area_show_event extends Migration
{
    public function up()
    {
        $this->createTable('area', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'description' => $this->text(),
            'sort' => $this->integer(),
        ]);

        $this->createTable('show', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'image' => $this->string(),
            'description' => $this->text(),
        ]);

        $this->createTable('event', [
            'id' => $this->primaryKey(),
            'date' => $this->timestamp(),
            'show_id' => $this->integer(),
            'area_id' => $this->integer(),
        ]);

        $this->createIndex(
            'idx-event-show_id',
            'event',
            'show_id'
        );

        $this->createIndex(
            'idx-event-area_id',
            'event',
            'area_id'
        );

        $this->addForeignKey(
            'fk-event-show_id',
            'event',
            'show_id',
            'show',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-event-area_id',
            'event',
            'area_id',
            'area',
            'id',
            'CASCADE'
        );

    }

    public function down()
    {
        $this->dropForeignKey('fk-event-area_id', 'event');
        $this->dropForeignKey('fk-event-show_id', 'event');
        $this->dropIndex('idx-event-area_id', 'event');
        $this->dropIndex('idx-event-show_id', 'event');

        $this->dropTable('area');
        $this->dropTable('show');
        $this->dropTable('event');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
