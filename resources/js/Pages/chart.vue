<template>
  <div>
    <b-container>
      <b-row>
        <b-col offset-md="2" md="8">
          <canvas id="myChart" width="400" height="400"></canvas>
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
    user: {
      type: Array,
      defaultValue() {
        return [];
      },
    },
  },
  mounted() {
    let ticketClose = [];
    let ticketCloseNotSolved = [];
    let ticketOpen = [];
    let ticketInProgress = [];
    this.ticket.forEach((element) => {
      if (element.date_end == null) {
        if (element.operateur_id == null) {
          ticketOpen.push(element);
        } else {
          ticketInProgress.push(element);
        }
      } else if (element.date_end != null) {
        if (element.solved == false) {
          ticketCloseNotSolved.push(element);
        } else {
          ticketClose.push(element);
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
              ticketOpen.length,
              ticketClose.length,
              ticketInProgress.length,
              ticketCloseNotSolved.length,
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
