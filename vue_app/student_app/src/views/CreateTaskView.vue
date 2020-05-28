<template>
  <v-container fluid>
    <v-row align="center" justify="center">
      <v-col cols="12" v-if="message.length">
        <v-alert
          dismissible
          :type="messageType"
          icon="mdi-cloud-alert"
          prominent
          @input="onClose"
        >{{message}}</v-alert>
      </v-col>
      <v-col cols="12" md="10">
        <v-card>
          <v-toolbar color="primary" dark flat>
            <v-toolbar-title>Create Task</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form" v-model="valid" :lazy-validation="true">
              <v-row>
                <v-col>
                  <v-text-field
                    v-model="title"
                    :rules="titleRules"
                    label="Title"
                    required
                  ></v-text-field>
                  <v-textarea
                    v-model="description"
                    :rules="descriptionRules"
                    label="Description"
                    required
                  ></v-textarea>
                </v-col>
                <v-col>
                  <v-select
                    :items="getTaskTypes"
                    :rules="typeRules"
                    label="Type"
                    v-model="type"
                    item-text="name"
                    item-value="id"
                    required
                    outlined
                  ></v-select>
                  <v-row>
                    <v-col cols="12" md="6">
                      <v-datetime-picker
                        label="Start date"
                        v-model="start_at"
                      >
                        <template slot="dateIcon">
                          <v-icon>mdi-calendar</v-icon>
                        </template>
                        <template slot="timeIcon">
                          <v-icon>mdi-clock-outline</v-icon>
                        </template>
                      </v-datetime-picker>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-datetime-picker label="End date" v-model="end_at">
                        <template slot="dateIcon">
                          <v-icon>mdi-calendar</v-icon>
                        </template>
                        <template slot="timeIcon">
                          <v-icon>mdi-clock-outline</v-icon>
                        </template>
                      </v-datetime-picker>
                    </v-col>
                  </v-row>
                  <v-select
                    :items="getSubjects"
                    item-text="name"
                    item-value="id"
                    label="Subject"
                    v-model="subject_id"
                    required
                    outlined
                    @change="subjectSelected"
                    :rules="subjectRules"
                  ></v-select>
                  <v-select
                    :items="subjectChapters"
                    item-text="name"
                    item-value="id"
                    label="Chapter"
                    v-model="chapter_id"
                    required
                    outlined
                    :rules="chapterRules"
                    v-if="subjectChapters.length"
                  ></v-select>
                </v-col>
              </v-row>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" :disabled="!valid" @click="validate">Create</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
import moment from "moment"
import { isEmpty } from 'lodash'

const DEFAULT_DATE_FORMAT = 'YYYY-MM-DD'
const DEFAULT_TIME_FORMAT = 'hh:mm:ss'

export default {
  data: () => ({
    valid: true,
    title: "",
    titleRules: [
      v => (v && !!v) || "Name is required",
      v => (v && v.length > 4) || "Name must be atleast of 4 characters"
    ],
    description: '',
    descriptionRules: [
      v => (v && !!v) || "Description is required",
    ],
    message: "",
    messageType: "",
    type: '',
    typeRules: [
      v => (v && !!v) || "Type is required",
    ],
    start_at:'',
    startAtRules: [
      v => (v && !!v) || "Start datetime is required",
    ],
    end_at:'',
    endAtRules: [
      v => (v && !!v) || "Start datetime is required",
    ],
    subject_id: '',
    subjectRules: [
      v => (v && !!v) || "Please select a subject",
    ],
    chapter_id: '',
    chapterRules: [
      v => (v && !!v) || "Please select a chapter",
    ],
    subjectChapters: [],
  }),
  computed: {
    defaultDateTimeFormat() {
      return DEFAULT_DATE_FORMAT + ' ' + DEFAULT_TIME_FORMAT
    },
    ...mapGetters({
      getSubjects: 'Subject/getSubjects',
      getTaskTypes: 'Task/getTypes',
    })
  },
  methods: {
    validate() {
      this.resetErrors()
      if (this.$refs.form.validate()) {
        if(!this.start_at) {
          this.messageType="error"
          this.message = "Please select start date"
          return
        }

        if(!this.end_at) {
          this.messageType="error"
          this.message = "Please select end date"
          return
        }

        let data = {
          title: this.title,
          description: this.description,
          type: this.type,
          start_at: moment(this.start_at).format(this.defaultDateTimeFormat),
          end_at: moment(this.end_at).format(this.defaultDateTimeFormat),
          subject_id: this.subject_id,
          chapter_id: this.chapter_id
        };

        this.createTask(data)
          .then((response) => {
            this.messageType = "success"
            this.message = "Task has been created!"
            this.resetForm()
            this.resetValidation()

          })
          .catch((error) => {
            let data = error.response.data
            this.messageType = "error"
            if (!isEmpty(data.errors)) {
              for (var key in data.errors) {
                    this.message = data.errors[key][0]
                    break
                }
            }
            else {
              this.message = data.message
            }
          })
      }
    },
    resetErrors() {
      this.message = ""
      this.messageType = ""
    },
    onClose() {
      this.resetMessage();
    },
    resetForm () {
        this.$refs.form.reset()
    },
    resetValidation () {
      this.$refs.form.resetValidation()
    },
    subjectSelected(value) {
      this.subjectChapters = []
      this.fetchSubjectChapters(value)
        .then((response) => {
            this.subjectChapters = response.data.data
          this.chapter_id = ''
        })
    },

    ...mapActions({
      fetchSubjects: 'Subject/fetchSubjects',
      fetchSubjectChapters: 'Subject/fetchSubjectChapters',
      createTask: 'Task/createTask',
    })
  },
  mounted() {
    this.fetchSubjects()
  }
};
</script>