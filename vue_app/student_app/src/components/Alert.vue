<template>
    <v-alert
      @input="onClose"
      dismissible
      type="error"
      icon="mdi-cloud-alert"
      prominent
    >
      Aenean imperdiet. Quisque id odio. Cras dapibus. Pellentesque ut neque. Cras dapibus.

      Vivamus consectetuer hendrerit lacus. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Sed mollis, eros et ultrices tempus, mauris ipsum aliquam libero, non adipiscing dolor urna a orci. Curabitur blandit mollis lacus. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo.
    </v-alert>
</template>

<script>
export default {
    methods: {
        onClose() {
            this.$emit('dismissed')
        }
    }
}
</script>