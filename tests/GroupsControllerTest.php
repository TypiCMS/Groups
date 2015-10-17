<?php

class GroupsControllerTest extends TestCase
{
    public function testAdminIndex()
    {
        $response = $this->call('GET', 'admin/groups');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStoreFails()
    {
        $input = [];
        $this->call('POST', 'admin/groups', $input);
        $this->assertRedirectedToRoute('admin.groups.create');
        $this->assertSessionHasErrors();
    }

    public function testStoreSuccess()
    {
        $input = ['name' => 'test', 'permissions' => []];
        $this->call('POST', 'admin/groups', $input);
        $this->assertRedirectedToRoute('admin.groups.edit', ['id' => 4]);
    }

    public function testStoreSuccessWithRedirectToList()
    {
        $input = ['name' => 'test', 'permissions' => [], 'exit' => true];
        $this->call('POST', 'admin/groups', $input);
        $this->assertRedirectedToRoute('admin.groups.index');
    }
}
