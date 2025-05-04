<?php

use PHPUnit\Framework\TestCase;

require_once 'src/models/AccountModel.php';
require_once 'src/filters/AccountFilters.php';
require_once 'src/repositories/AccountRepo.php';

class AccountRepoTest extends TestCase
{
    private $pdoMock;
    private $stmtMock;
    private $accountRepo;

    protected function setUp(): void
    {
        $this->pdoMock = $this->createMock(PDO::class);
        $this->stmtMock = $this->createMock(PDOStatement::class);
    
        require_once 'src/repositories/AccountRepo.php';
        $this->accountRepo = new AccountRepo();
        $this->accountRepo->con = $this->pdoMock; // manually inject mock PDO
    }
    

    public function testInsertSuccess(): void
    {
        $account = new Account();
        $account->email = 'test@example.com';
        $account->password = 'hashed_password';
        $account->accountType = 'admin';
        $account->status = 'active';

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("INSERT INTO"))
            ->willReturn($this->stmtMock);

        $this->stmtMock->expects($this->once())
            ->method('execute')
            ->with($this->arrayHasKey(':email'))
            ->willReturn(true);

        $this->stmtMock->expects($this->once())
            ->method('rowCount')
            ->willReturn(1);

        $result = $this->accountRepo->insert($account);

        $this->assertTrue($result);
    }

    public function testSelectByFilterReturnsData(): void
    {
        $filter = new AccountFilter();
        $expectedData = [['id' => 1, 'email' => 'test@example.com']];

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM"))
            ->willReturn($this->stmtMock);

        $this->stmtMock->expects($this->once())
            ->method('execute')
            ->with($this->isType('array'))
            ->willReturn(true);

        $this->stmtMock->expects($this->once())
            ->method('fetchAll')
            ->willReturn($expectedData);

        $result = $this->accountRepo->selectByFilter($filter);

        $this->assertIsArray($result);
        $this->assertEquals($expectedData, $result);
    }

    public function testCountByFilterReturnsData(): void
    {
        $filter = new AccountFilter();
        $expectedCount = 5;

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("SELECT COUNT(*) as total"))
            ->willReturn($this->stmtMock);

        $this->stmtMock->expects($this->once())
            ->method('execute')
            ->with($this->isType('array'))
            ->willReturn(true);

        $this->stmtMock->expects($this->once())
            ->method('fetch')
            ->willReturn(['total' => $expectedCount]);

        $result = $this->accountRepo->countByFilter($filter);

        $this->assertIsArray($result);
        $this->assertEquals(['total' => $expectedCount], $result);
    }

    public function testUpdateStatusSuccess(): void
    {
        $id = 1;
        $status = 'inactive';

        $this->pdoMock->expects($this->once())
            ->method('prepare')
            ->with($this->stringContains("UPDATE accounts SET status"))
            ->willReturn($this->stmtMock);

        $this->stmtMock->expects($this->once())
            ->method('execute')
            ->with([
                ':status' => $status,
                ':id' => $id
            ])
            ->willReturn(true);

        $this->stmtMock->expects($this->once())
            ->method('rowCount')
            ->willReturn(1);

        $result = $this->accountRepo->updateStatus($id, $status);

        $this->assertTrue($result);
    }
}
