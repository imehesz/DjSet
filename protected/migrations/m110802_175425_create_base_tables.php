<?php
/**
 * m110802_175425_create_base_tables 
 * 
 * @uses CDbMigration
 * @package 
 * @version $id$
 * @copyright Clevertech
 * @author Imre Mehesz <imre@clevertech.biz> 
 * @license PHP Version 5 {@link http://www.php.net/license/3_01.txt}
 */
class m110802_175425_create_base_tables extends CDbMigration
{
	public function up()
	{
        $this->createTable( 
            'artist',
            array(
                'id'            => 'pk',
                'name'          => 'varchar(255)',
                'create_date'   => 'int'
            )
        );

        $this->createTable(
            'song',
            array(
                'id'            => 'pk',
                'artist_id'     => 'int',
                'title'         => 'varchar(255)',
                'year'          => 'smallint',
                'bpm'           => 'smallint',
                'source'        => 'text',
                'create_date'   => 'int'
            )
        );

        $this->createTable(
            'crate',
            array(
                'id'            => 'pk',
                'name'          => 'varchar(255)',
                'create_date'   => 'int'
            )
        );

        $this->createTable(
            'assoc_song_crate',
            array(
                'song_id'       => 'int',
                'crate_id'      => 'int',
                'sort_order'    => 'real',
                'create_date'   => 'int'
            )
        );

	}

	public function down()
	{
        $this->dropTable( 'artist' );
        $this->dropTable( 'song' );
        $this->dropTable( 'crate' );
        $this->dropTable( 'assoc_song_crate' );
	}
}
