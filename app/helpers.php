<?php

/**
 * Get super admin role name.
 */
function getSuperAdminRoleName() {
  return env('SOC_APP_SUPER_ADMIN_ROLE', 'Super Admin');
}