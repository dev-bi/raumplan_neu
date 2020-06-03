console.log("Hallo");

let currentFloorplanId = '';

const biRoomPlanNavigator = Vue.component('bi-room-plan-navigator', {
    template: `
        <div>
            <p>Du siehst gerade den Raumplan von {{ getCurrentFloor(true) }}</p>
            <div>
            <div class="msg msg-danger">{{ status }}</div>
            <button @click="down">Etage niedriger</button><button @click="up">Etage höher</button>
            </div>
        </div>
    `,
    data: function () {
        return {
            floor: ['KG', 'EG', 'OG1', 'OG2'],
            floorIdObj: {
                'OG1': 'nw10og1',
                'OG2': 'nw10og2',
                'KG': 'nw10og1',
                'EG': 'nw10og2'
            },
            floorplanid: currentFloorplanId,
            currentFloor: 0,
            location: ['Nagelsweg 10', 'Nagelsweg 14', 'Rosenallee 21'],
            currentLocation: 0,
            status: ''
        };
    },
    methods: {
            getCurrentFloor(withFullAdress = false) { 
                if (withFullAdress) {
                    return `${this.location[this.currentLocation]} - Etage: ${this.floor[this.currentFloor]}`;
                }
                return this.floor[this.currentFloor];
            },
            up() {
                if(this.currentFloor < this.floor.length - 1) {
                    console.log(this.currentFloor);
                    console.log(this.floor.length - 1);
                    this.currentFloor += 1;
                    currentFloorplanId = this.floorIdObj[this.floor[this.currentFloor]];
                }
            },
            down() {
                if(this.currentFloor > 0) {
                    this.currentFloor -= 1;
                    currentFloorplanId = this.floorIdObj[this.floor[this.currentFloor]];
                }
            }
        }
});

const biFloorPlan = Vue.component('bi-floor-plan', {
    template: `<div>
                    <div v-html="roomdata" @click="where" @mouseover="selRoom" @mouseout="unselRoom"></div>
                    <div><button @click="getRoomData">Hole Raumdaten</button></div>
                </div>`,
    data: function () {
        return {
            floorplanid: currentFloorplanId,
            roomdata: 'Keine Raumdaten',
        };
    },
    methods: {
        getRoomData() {
            fetch('http://localhost/floorplan_juni/api/floorplan?rid=' + currentFloorplanId)
            .then((response) => response.text())
            .then((data) => {
                this.roomdata = data;
            });
        },
        selRoom(event) {
            if(event.target.className.baseVal === 'room') {
                console.log(event.target.id);
                event.target.style.fill = 'rgb(0, 255, 0)';
            }
        },
        unselRoom(event) {
            if (event.target.className.baseVal === 'room') {
                event.target.style.fill = 'rgb(255, 255, 255)';
            }
        },
        where(event) {
            console.log(event.target.baseVal);
        }
    }
});

const app = new Vue({
    el: '#app',
    data: {
        roomdata: `Keine Raumdaten geladen`,
    },
});