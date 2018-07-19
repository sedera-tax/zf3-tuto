<?php

namespace Blog\Model;

use InvalidArgumentException;
use RuntimeException;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Hydrator\HydratorInterface;
use Zend\Db\ResultSet\HydratingResultSet;

class ZendDbSqlRepository implements PostRepositoryInterface {
	/**
	 * @var AdapterInterface
	 */
	private $db;

	/**
	 * @var HydratorInterface
	 */
	private $hydrator;

	/**
	 * @var Post
	 */
	private $postPrototype;

	/**
	 * @var string
	 */
	private $table = 'posts';

	/**
	 * ZendDbSqlRepository constructor.
	 *
	 * @param AdapterInterface $db
	 * @param HydratorInterface $hydrator
	 * @param Post $postPrototype
	 */
	public function __construct( AdapterInterface $db, HydratorInterface $hydrator, Post $postPrototype ) {
		$this->db            = $db;
		$this->hydrator      = $hydrator;
		$this->postPrototype = $postPrototype;
	}

	/**
	 * @return array Post
	 */
	public function findAllPosts() {
		$sql = new Sql($this->db);
		$select = $sql->select($this->table)->order('id');
		$statement = $sql->prepareStatementForSqlObject($select);
		$result = $statement->execute();

		if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
			return [];
		}

		$resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
		$resultSet->initialize($result);
		return $resultSet;
	}

	/**
	 * @param int $id
	 * @return Post
	 */
	public function findPost( $id ) {
		$sql = new Sql($this->db);
		$select = $sql->select($this->table)->where(['id = ?' => $id]);
		$statement = $sql->prepareStatementForSqlObject($select);
		$result = $statement->execute();

		if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
			throw new RuntimeException(sprintf('Failed retrieving blog post with identifier "%s"; unknown database error.', $id));
		}

		$resultSet = new HydratingResultSet($this->hydrator, $this->postPrototype);
		$resultSet->initialize($result);
		$post = $resultSet->current();

		if (!$post) {
			throw new InvalidArgumentException(sprintf('Blog post with identifier "%s" not found.', $id));
		}

		return $post;
	}

}