<template>
  <div>
    <b-container>
      <b-row class="w-100">
        <b-col offset-md="0" md="6">
          <canvas id="myChart" width="400" height="400"></canvas>
        </b-col>
        <b-col>
          <b-container>
            <b-row offset-md="0" class="element">
              <b-badge variant="info" pill>
                Nombre d'opérateur: <strong>{{ operateur.length }}</strong>
              </b-badge>
            </b-row>
            <b-row offset-md="0" class="element">
              <b-badge pill variant="danger"
                >Nombre total de ticket:<strong>
                  {{
                    this.ticketOpen.length + this.ticketInProgress.length
                  }}</strong
                >
              </b-badge>
            </b-row>
            <b-row offset-md="0" class="element">
              <b-badge pill variant="warning">
                Nombre moyen de ticket par opérateur:<strong>
                  {{
                    this.ticketOpen.length +
                    this.ticketInProgress.length / operateur.length
                  }}</strong
                >
              </b-badge>
            </b-row>
            <b-row offset-md="0" class="element">
              <b-badge pill variant="secondary">
                Proportion de ticket résolu:<strong>
                  {{
                    Math.round((this.ticketClose.length /
                      (this.ticketCloseNotSolved.length +
                        this.ticketClose.length)) *
                    100)
                  }}%</strong
                >
              </b-badge>
            </b-row>
          </b-container>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>
<script>
import { Chart, registerables } from "chart.js";

export default {
  name: "Stats",
  props: {
    ticket: {
      type: Array,
      defaultValue() {
        return [];
      },
    },
    operateur: {
      type: Array,
      defaultValue() {
        return [];
      },
    },
  },
  data() {
    return {
      ticketClose: [],
      ticketCloseNotSolved: [],
      ticketOpen: [],
      ticketInProgress: [],
    };
  },
  mounted() {
    this.ticket.forEach((element) => {
      if (element.date_end == null) {
        if (element.operateur_id == null) {
          this.ticketOpen.push(element);
        } else {
          this.ticketInProgress.push(element);
        }
      } else if (element.date_end != null) {
        if (element.solved == false) {
          this.ticketCloseNotSolved.push(element);
        } else {
          this.ticketClose.push(element);
        }
      }
    });
    Chart.register(...registerables);
    const ctx = document.querySelector("#myChart");
    const myChart = new Chart(ctx, {
      type: "pie",
      data: {
        labels: [
          "Nombre de ticket ouvert",
          "Nombre de ticket fermé résolu",
          "Nombre de ticket en cours",
          "Nombre de ticket fermé pas résolu",
        ],
        datasets: [
          {
            data: [
              this.ticketOpen.length,
              this.ticketClose.length,
              this.ticketInProgress.length,
              this.ticketCloseNotSolved.length,
            ],
            backgroundColor: [
              "rgba(255, 0, 0, 0.5)",
              "rgba(0, 0, 255, 0.5)",
              "rgba(0, 255, 0, 0.5)",
              "rgba(34, 147, 216, 0.5)",
            ],
            borderColor: [
              "rgba(255, 0, 0, 1)",
              "rgba(0, 0, 255, 1)",
              "rgba(0, 255, 0, 1)",
              "rgba(34, 147, 216, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: "Statistiques des tickets",
          },
        },
      },
    });
  },
};
</script>
<style scoped>
.element {
  margin: 10px;
}
</style>
