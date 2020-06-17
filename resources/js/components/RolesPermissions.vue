<template>
  <v-container
    fluid
    >
    <v-row
        justify="center"
        class="pa-4"
    >
      <v-expansion-panels>
        <v-expansion-panel
          v-for="(role, i) in roles"
          :key="i"
          :class="(i===0) ? 'mb-6' : ''"
        >
          <v-expansion-panel-header
            flat
            dark
            color="white"
          >
            {{ role.name }} permissions
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-row>
              <v-col
                cols="3"
                v-for="(permission, key) in permissions"
                :key="key"
              >
                <v-checkbox
                  v-model="assignPermissions"
                  :label="permission.name | formatPermissionName"
                  :value="role.id + '-' + permission.name"
                ></v-checkbox>
              </v-col>
            </v-row>
            <v-row>
              <v-spacer></v-spacer>
              <v-btn
                color="primary"
                @click="syncPermissions(role.id)"
              >
              Sync
              </v-btn>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-row>
  </v-container>
</template>

<script>
import { remove, includes, map } from 'lodash'

export default {
  props:['userRoles', 'rolePermissions'],
  data() {
    return {
      assignPermissions:[],
      roles: this.userRoles || [],
      permissions: this.rolePermissions || [],
    }
  },
  filters: {
    formatPermissionName(value) {
      if (!value) return '';
      return value.charAt(0).toUpperCase() + value.slice(1).replace(/_/g, ' ');
    }
  },
  mounted() {
    this.roles.map((role) => {
      if (role.permissions && role.permissions.length) {
        role.permissions.map((permission) => {
          this.assignPermissions.push(role.id + '-' + permission.name)
        })
      }
    });
  },
  methods: {
    parseSelection(roleId) {
      if(this.assignPermissions.length === 0 ) return
      let permissionsToAssign = [];
      this.assignPermissions.map(function (p) {
        let data = p.split('-');
        if (parseInt(data[0]) !== roleId) return
        permissionsToAssign.push(data[1]);
      })
      return permissionsToAssign;
    },
    syncPermissions(roleId) {
      let permissions = this.parseSelection(roleId);
      if (permissions) {
        httpClient.put(`/roles/${roleId}/assign-permissions`, {permissions: permissions, _method: 'POST'})
            .then(response => {
                this.$toast.success('Permission Assigned!' ,{
                  dismissable: true,
                  queueable: true,
                  timeout: 5000,
                })
            })
            .catch(error => {
              this.$toast.error(error.response.data.message ,{
                dismissable: true,
                queueable: true,
                timeout: 5000,
              })
            });
      }
    },
    getInputValue(roleId, permissionName) {
      if (this.assignPermissions[roleId] && includes(this.assignPermissions[roleId], permissionName)) {
        return permissionName;
      }
    }
  }
}
</script>