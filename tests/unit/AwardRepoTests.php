<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../../src/repositories/AwardRepo.php';
require_once __DIR__ . '/../../src/models/AwardModel.php';

class AwardRepoTest extends TestCase
{
    private $pdoMock;
    private $stmtMock;

    protected function setUp(): void
    {
        // Mock PDOStatement
        $this->stmtMock = $this->createMock(PDOStatement::class);

        // Mock PDO and make it return the statement mock
        $this->pdoMock = $this->createMock(PDO::class);
        $this->pdoMock->method('prepare')->willReturn($this->stmtMock);
    }

    public function testInsertAwardSuccessfullyExecutes()
    {
        // Arrange
        $awardData = [
            'awardType' => 'Employee',
            'awardName' => 'Best Worker',
            'awardFrom' => 'HR Department',
            'awardDate' => '2024-05-01'
        ];
        $award = new Award($awardData);

        // Set expectation on bindParam to simulate success
        $this->stmtMock->expects($this->exactly(4))->method('bindParam');
        $this->stmtMock->expects($this->once())->method('execute')->willReturn(true);

        // Act
        $repo = new AwardRepo();  // No need to pass PDO here, it will use the mock set in `setUp()`
        $repo->con = $this->pdoMock; // Access the protected $con and assign the mock
        $result = $repo->insert($award);

        // Assert
        $this->assertTrue($result);
    }

    public function testSelectAllReturnsAwards()
    {
        $awardData = [
            ['awardId' => 1, 'awardType' => 'Employee', 'awardName' => 'Best Worker', 'awardFrom' => 'HR', 'awardDate' => '2024-05-01'],
            ['awardId' => 2, 'awardType' => 'Team', 'awardName' => 'Best Team', 'awardFrom' => 'Management', 'awardDate' => '2024-06-01']
        ];

        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetchAll')->willReturn($awardData);

        $repo = new AwardRepo();
        $repo->con = $this->pdoMock; // Access the protected $con and assign the mock
        $result = $repo->selectAll();

        $this->assertCount(2, $result);
        $this->assertEquals(1, $result[0]['awardId']);
        $this->assertEquals('Best Worker', $result[0]['awardName']);
    }

    public function testSelectOneReturnsCorrectAward()
    {
        $awardData = [
            'awardId' => 1, 
            'awardType' => 'Employee', 
            'awardName' => 'Best Worker', 
            'awardFrom' => 'HR', 
            'awardDate' => '2024-05-01'
        ];

        $this->stmtMock->method('execute')->willReturn(true);
        $this->stmtMock->method('fetch')->willReturn($awardData);

        $repo = new AwardRepo();
        $repo->con = $this->pdoMock; // Access the protected $con and assign the mock
        $result = $repo->selectOne(1);

        $this->assertEquals(1, $result['awardId']);
        $this->assertEquals('Best Worker', $result['awardName']);
    }

    public function testDeleteReturnsTrueOnSuccess()
    {
        $awardId = 1;

        $this->stmtMock->method('execute')->willReturn(true);

        $repo = new AwardRepo();
        $repo->con = $this->pdoMock; // Access the protected $con and assign the mock
        $result = $repo->delete($awardId);

        $this->assertTrue($result);
    }
}
